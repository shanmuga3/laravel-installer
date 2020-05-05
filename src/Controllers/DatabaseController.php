<?php

/**
 * This file is part of Laravel Installer,
 * Web Installer for Laravel Application.
 *
 * @license     MIT
 * @package     Shanmuga\LaravelInstaller
 * @category    Controllers
 * @author      Shanmugarajan
 */

namespace Shanmuga\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Shanmuga\LaravelInstaller\Helpers\DatabaseManager;
use Shanmuga\LaravelInstaller\Helpers\EnvironmentManager;
use Validator;
use DB;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $EnvironmentManager;

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(EnvironmentManager $environmentManager,DatabaseManager $databaseManager)
    {
        $this->EnvironmentManager = $environmentManager;
        $this->databaseManager = $databaseManager;
    }

    /**
     * Display the Application Settings page.
     *
     * @return \Illuminate\View\View
     */
    public function applicationSettings()
    {
        $envForm = $this->EnvironmentManager->getAppFormContent();

        return view('vendor.installer.application_settings', compact('envForm'));
    }

     /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function database(Request $request,Redirector $redirect)
    {
        $envForm = collect($this->EnvironmentManager->getAppFormContent());
        $rules = array();
        $messages = [
            'environment_custom.required_if' => trans('installer_messages.environment.wizard.form.name_required'),
        ];  

        $envForm->each(function($form) use (&$rules) {
            $rule = $form['rules'] ?? [];
            $rules = array_merge($rules,$rule);
        });

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $redirect->route('installer.application_settings')->withInput()->withErrors($validator->errors());
        }

        $response = $this->databaseManager->migrateAndSeed();

        if($response['status'] == 'success') {
            $envForm->each(function($form) use ($request) {
                $model = new $form['model'];
                try {
                    if($form['type'] == 'check_column') {
                        foreach ($form['fields'] as $field) {
                            $model->updateOrCreate(
                                [$form['check_column'] => $field['key']],
                                ['value' => $request[$field['key']]]
                            );
                        }
                    }
                    if($form['type'] == 'find_by_id') {
                        $model = $model->find($form['find_by_id']);
                        foreach ($form['fields'] as $field) {
                            $key = $field['key'];
                            $model->$key = $request[$field['key']];
                        }
                        $model->save();
                    }
                }
                catch (\Exception $e) {
                    
                }
            });
        }

        return redirect()->route('installer.final')
                         ->with(['message' => $response]);
    }
}