<?php

Route::group(['prefix' => 'install', 'namespace' => 'Shanmuga\LaravelInstaller\Controllers', 'middleware' => ['web', 'install']], function () {

    Route::get('/','WelcomeController@welcome')->name('installer.welcome');

    Route::get('environment','EnvironmentController@environmentMenu')->name('installer.environment');

    Route::get('environment/wizard','EnvironmentController@environmentWizard')->name('installer.environmentWizard');

    Route::post('environment/saveWizard', 'EnvironmentController@saveWizard')->name('installer.environmentSaveWizard');

    Route::get('environment/classic', 'EnvironmentController@environmentClassic')->name('installer.environmentClassic');

    Route::post('environment/saveClassic', 'EnvironmentController@saveClassic')->name('installer.environmentSaveClassic');

    Route::get('requirements', 'RequirementsController@requirements')->name('installer.requirements');

    Route::get('permissions', 'PermissionsController@permissions')->name('installer.permissions');

    Route::get('database', 'DatabaseController@database')->name('installer.database');

    Route::get('final', 'FinalController@finish')->name('installer.final');
});