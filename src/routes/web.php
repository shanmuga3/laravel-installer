<?php

Route::group(['prefix' => 'install', 'namespace' => 'Shanmuga\LaravelInstaller\Controllers', 'middleware' => ['web', 'install']], function () {

    Route::get('/','WelcomeController@welcome')->name('installer.welcome');

    Route::get('environment','EnvironmentController@environmentWizard')->name('installer.environment');

    Route::post('environment/saveWizard', 'EnvironmentController@saveWizard')->name('installer.environmentSaveWizard');

    Route::get('requirements', 'RequirementsController@requirements')->name('installer.requirements');

    Route::get('permissions', 'PermissionsController@permissions')->name('installer.permissions');

    Route::get('database', 'DatabaseController@database')->name('installer.database');

    Route::get('final', 'FinalController@finish')->name('installer.final');
});