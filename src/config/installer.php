<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '7.0.0',
    ],
    'final' => [
        'key' => true,
    ],
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'ctype',
            'fileinfo',
            'bcmath',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775',
        '.env'                   => '775',
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Form Wizard Validation Rules & Messages
    |--------------------------------------------------------------------------
    |
    | This are the default form field validation rules. Available Rules:
    | https://laravel.com/docs/master/validation#available-validation-rules
    |
    */
    'environment' => [
        'form' => [
            'rules' => [
                'app_name'              => 'required|string|max:50',
                'environment'           => 'required|string|max:50',
                'environment_custom'    => 'required_if:environment,other|max:50',
                'app_debug'             => 'required|boolean',
                'app_log_level'         => 'required|string|max:50',
                'app_url'               => 'required|url',
                'database_connection'   => 'required|string|max:50',
                'database_hostname'     => 'required|string|max:50',
                'database_port'         => 'required|numeric',
                'database_name'         => 'required|string|max:50',
                'database_username'     => 'required|string|max:50',
                'database_password'     => 'nullable|string|max:50',
                'broadcast_driver'      => 'required|string|max:50',
                'cache_driver'          => 'required|string|max:50',
                'session_driver'        => 'required|string|max:50',
                'queue_connection'      => 'required|string|max:50',
            ],
        ],
        'application' => [
            'tab1' => [
                'name'      => 'Site Settings',
                'table'     => 'site_settings',
                'fields'    => [
                    ['key'   => 'site_name','label' => 'Site Name','value' => 'Site Name'],
                    ['key'   => 'admin_url','label' => 'Admin URL','value' => 'admin'],
                    ['key'   => 'timezone','label' => 'Timezone','value' => 'UTC'],
                ],
                'rules'     => [
                    'site_name' => 'required',
                    'admin_url' => 'required',
                    'timezone'  => 'required',
                ],
            ],
            'tab2' => [
                'name' => 'Email Settings',
                'table' => 'email_settings',
                'fields'    => [
                    ['key'   => 'mail_driver','label' => 'Mail Driver','value' => 'smtp'],
                    ['key'   => 'mail_host','label' => 'Mail Host','value' => 'smtp.gmail.com'],
                    ['key'   => 'mail_port','label' => 'Mail Port','value' => '587'],
                    ['key'   => 'mail_from_address','label' => 'From Address','value' => ''],
                    ['key'   => 'mail_from_name','label' => 'From Name','value' => ''],
                    ['key'   => 'mail_encryption','label' => 'Encryption','value' => 'tls'],
                    ['key'   => 'mail_username','label' => 'Mail Username','value' => ''],
                    ['key'   => 'mail_password','label' => 'Mail Password','value' => ''],
                ],
                'rules'     => [
                    'mail_driver' => 'required',
                    'mail_host' => 'required',
                    'mail_port'  => 'required',
                    'mail_from_address' => 'required',
                    'mail_from_name' => 'required',
                    'mail_encryption' => 'required',
                    'mail_username' => 'required',
                    'mail_password'  => 'required',
                ],
            ],
            'tab3' => [
                'name' => 'Admin User',
                'table' => 'admins',
                'fields'    => [
                    ['key'   => 'admin_user_name','label' => 'User Name','value' => 'admin'],
                    ['key'   => 'admin_password','label' => 'Password','value' => '','placeholder' => 'Password'],
                ],
                'rules'     => [
                    'admin_user_name' => 'required',
                    'admin_password' => 'required',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Installed Middleware Options
    |--------------------------------------------------------------------------
    | Different available status switch configuration for the
    | canInstall middleware located in `canInstall.php`.
    |
    */
    'installed' => [
        'redirectOptions' => [
            'route' => [
                'name' => 'welcome',
                'data' => [],
            ],
            'abort' => [
                'type' => '404',
            ],
            'dump' => [
                'data' => 'Dumping a not found message.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Selected Installed Middleware Option
    |--------------------------------------------------------------------------
    | The selected option fo what happens when an installer instance has been
    | Default output is to `/resources/views/error/404.blade.php` if none.
    | The available middleware options include:
    | route, abort, dump, 404, default, ''
    |
    */
    'installedAlreadyAction' => '',
];
