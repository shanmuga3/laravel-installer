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
use Shanmuga\LaravelInstaller\Helpers\EnvironmentManager;
use Shanmuga\LaravelInstaller\Helpers\FinalInstallManager;
use Shanmuga\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \Shanmuga\LaravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \Shanmuga\LaravelInstaller\Helpers\FinalInstallManager $finalInstall
     * @param \Shanmuga\LaravelInstaller\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
