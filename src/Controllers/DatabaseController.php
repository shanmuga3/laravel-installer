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
use Shanmuga\LaravelInstaller\Helpers\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('installer.final')
                         ->with(['message' => $response]);
    }
}
