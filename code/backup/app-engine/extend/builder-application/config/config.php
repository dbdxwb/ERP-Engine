<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Source',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled'            => false,
        'path'               => base_path() . '/extend/builder-application/src/Commands/stubs',
        'files'              => [
            'routes/web'      => 'Routes/web.php',
            'routes/api'      => 'Routes/api.php',
            'views/index'     => 'Resources/views/index.blade.php',
            'views/master'    => 'Resources/views/layouts/master.blade.php',
            'scaffold/config' => 'Config/config.php',
            'composer'        => 'composer.json',
            'assets/js/app'   => 'Resources/assets/js/app.js',
            'assets/sass/app' => 'Resources/assets/sass/app.scss',
            'webpack'         => 'webpack.mix.js',
            'package'         => 'package.json',
        ],
        'admin_files'        => [
            'admin/routes'                                                    => 'Routes/admin.php',
            'admin/config'                                                    => 'Config/admin.php',
            'admin/bootstrap'                                                 => 'Bootstrap/bootstrap.php',
            'admin/database/migrations/2016_01_04_173148_create_admin_tables' => 'Database/Migrations/2016_01_04_173148_create_admin_tables.php',
            'admin/controller/AdminController'                                => 'Http/Controllers/Admin/AdminController.php',
            'admin/controller/AuthController'                                 => 'Http/Controllers/Admin/AuthController.php',
            'admin/controller/Dashboard'                                      => 'Http/Controllers/Admin/Dashboard.php',
            'admin/controller/EditorMDController'                             => 'Http/Controllers/Admin/EditorMDController.php',
            'admin/controller/HandleActionController'                         => 'Http/Controllers/Admin/HandleActionController.php',
            'admin/controller/HandleFormController'                           => 'Http/Controllers/Admin/HandleFormController.php',
            'admin/controller/HomeController'                                 => 'Http/Controllers/Admin/HomeController.php',
            'admin/controller/IconController'                                 => 'Http/Controllers/Admin/IconController.php',
            'admin/controller/LogController'                                  => 'Http/Controllers/Admin/LogController.php',
            'admin/controller/MenuController'                                 => 'Http/Controllers/Admin/MenuController.php',
            'admin/controller/PermissionController'                           => 'Http/Controllers/Admin/PermissionController.php',
            'admin/controller/RenderableController'                           => 'Http/Controllers/Admin/RenderableController.php',
            'admin/controller/RoleController'                                 => 'Http/Controllers/Admin/RoleController.php',
            'admin/controller/UserController'                                 => 'Http/Controllers/Admin/UserController.php',
            'admin/controller/ValueController'                                => 'Http/Controllers/Admin/ValueController.php',
            'admin/middleware/Application'                                    => 'Http/Middleware/Admin/Application.php',
            'admin/middleware/Authenticate'                                   => 'Http/Middleware/Admin/Authenticate.php',
            'admin/middleware/LogOperation'                                   => 'Http/Middleware/Admin/LogOperation.php',
            'admin/middleware/Permission'                                     => 'Http/Middleware/Admin/Permission.php',
            'admin/middleware/Pjax'                                           => 'Http/Middleware/Admin/Pjax.php',
            'admin/middleware/Session'                                        => 'Http/Middleware/Admin/Session.php',
            'admin/middleware/WebUploader'                                    => 'Http/Middleware/Admin/WebUploader.php',
            'admin/model/Administrator'                                       => 'Models/Admin/Administrator.php',
            'admin/model/Menu'                                                => 'Models/Admin/Menu.php',
            'admin/model/MenuCache'                                           => 'Models/Admin/MenuCache.php',
            'admin/model/OperationLog'                                        => 'Models/Admin/OperationLog.php',
            'admin/model/Permission'                                          => 'Models/Admin/Permission.php',
            'admin/model/Role'                                                => 'Models/Admin/Role.php',
            'admin/model/Repositories/Administrator'                          => 'Repositories/Admin/Administrator.php',
            'admin/model/Repositories/Menu'                                   => 'Repositories/Admin/Menu.php',
            'admin/model/Repositories/OperationLog'                           => 'Repositories/Admin/OperationLog.php',
            'admin/model/Repositories/Permission'                             => 'Repositories/Admin/Permission.php',
            'admin/model/Repositories/Role'                                   => 'Repositories/Admin/Role.php',
            'admin/AdminTablesSeeder'                                         => 'Database/Seeders/AdminTablesSeeder.php',
        ],
        'replacements'       => [
            'routes/web'      => ['LOWER_NAME', 'STUDLY_NAME'],
            'routes/api'      => ['LOWER_NAME'],
            'webpack'         => ['LOWER_NAME'],
            'json'            => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'views/index'     => ['LOWER_NAME'],
            'views/master'    => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer'        => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
            ],
        ],
        'admin_replacements' => [
            'admin/config'                                                    => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/database/migrations/2016_01_04_173148_create_admin_tables' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/AdminController'                                => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/AuthController'                                 => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/Dashboard'                                      => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/EditorMDController'                             => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/HandleActionController'                         => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/HandleFormController'                           => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/HomeController'                                 => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/IconController'                                 => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/LogController'                                  => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/MenuController'                                 => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/PermissionController'                           => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/RenderableController'                           => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/RoleController'                                 => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/UserController'                                 => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/controller/ValueController'                                => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/Application'                                    => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/Authenticate'                                   => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/LogOperation'                                   => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/Permission'                                     => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/Pjax'                                           => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/Session'                                        => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/middleware/WebUploader'                                    => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Administrator'                                       => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Menu'                                                => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/MenuCache'                                           => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/OperationLog'                                        => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Permission'                                          => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Role'                                                => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Repositories/Administrator'                          => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Repositories/Menu'                                   => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Repositories/OperationLog'                           => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Repositories/Permission'                             => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
            'admin/model/Repositories/Role'                                   => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'MODULE_NAMESPACE'
            ],
        ],
        'gitkeep'            => true,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Source path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
        */

        'source' => base_path('Source'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
        */

        'assets' => public_path('source'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'builder-application:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),
        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
        */
        'generator' => [
            'config'        => ['path' => 'Config', 'generate' => true],
            'command'       => ['path' => 'Console', 'generate' => true],
            'migration'     => ['path' => 'Database/Migrations', 'generate' => true],
            'seeder'        => ['path' => 'Database/Seeders', 'generate' => true],
            'factory'       => ['path' => 'Database/factories', 'generate' => true],
            'model'         => ['path' => 'Models', 'generate' => true],
            'bootstrap'     => ['path' => 'Bootstrap', 'generate' => true],
            'controller'    => ['path' => 'Http/Controllers', 'generate' => true],
            'filter'        => ['path' => 'Http/Middleware', 'generate' => true],
            'request'       => ['path' => 'Http/Requests', 'generate' => true],
            'provider'      => ['path' => 'Providers', 'generate' => true],
            'assets'        => ['path' => 'Resources/assets', 'generate' => true],
            'lang'          => ['path' => 'Resources/lang', 'generate' => true],
            'views'         => ['path' => 'Resources/views', 'generate' => true],
            'test'          => ['path' => 'Tests', 'generate' => true],
            'repository'    => ['path' => 'Repositories', 'generate' => true],
            'event'         => ['path' => 'Events', 'generate' => false],
            'listener'      => ['path' => 'Listeners', 'generate' => false],
            'policies'      => ['path' => 'Policies', 'generate' => false],
            'rules'         => ['path' => 'Rules', 'generate' => false],
            'jobs'          => ['path' => 'Jobs', 'generate' => false],
            'emails'        => ['path' => 'Emails', 'generate' => false],
            'notifications' => ['path' => 'Notifications', 'generate' => false],
            'resource'      => ['path' => 'Transformers', 'generate' => false],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths'   => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'builder-source',
        'author' => [
            'name'  => 'LZQ',
            'email' => '646196128@qq.com',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache'    => [
        'enabled'  => false,
        'key'      => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files'        => 'register',
    ],
];
