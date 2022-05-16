<?php
    return [
        'default' => 'mysql',
        'connections' => [
            'mysql' => [
                'driver' => 'mysql',
                'host' => env('APP_DB_HOST', 'oddhill-mysql'),
                'port' => '3306',
                'database' => 'database',
                'username' => 'root',
                'password' => 'password',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'strict' => true,
                'options' => extension_loaded('pdo_mysql') ? array_filter(
                    [
                    PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                    ]
                ) : [],
                'prefix' => '',
                'strict' => true,
                'engine' => null,
                'modes' => [
                    'ONLY_FULL_GROUP_BY',
                    'STRICT_TRANS_TABLES',
                    'NO_ZERO_IN_DATE',
                    'NO_ZERO_DATE',
                    'ERROR_FOR_DIVISION_BY_ZERO',
                    'NO_ENGINE_SUBSTITUTION',
                ],
            ],
        ],
        'migrations' => 'migrations',
    ];
