<?php

/**
 * This file is part of Laravel Installer,
 * Web Installer for Laravel Application.
 *
 * @license     MIT
 * @package     Shanmuga\LaravelInstaller
 * @category    Helpers
 * @author      Shanmugarajan
 */

if (! function_exists('isInstallerRouteActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string       $className
     * @return string
     */
    function isInstallerRouteActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}
