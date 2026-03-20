<?php

namespace App\Libraries;

use Config\Database as DatabaseConfig;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Bootstrap Eloquent (Laravel ORM) per usarlo in CodeIgniter 4.
 * Usa la stessa configurazione di app/Config/Database.php (gruppo default).
 */
class EloquentBoot
{
    private static bool $booted = false;

    public static function boot(): void
    {
        if (self::$booted) {
            return;
        }

        $config = (new DatabaseConfig())->default;
        $driver = strtolower($config['DBDriver'] ?? 'MySQLi');
        if ($driver === 'mysqli') {
            $driver = 'mysql';
        }

        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => $driver,
            'host' => $config['hostname'] ?? 'localhost',
            'port' => $config['port'] ?? 3306,
            'database' => $config['database'] ?? '',
            'username' => $config['username'] ?? '',
            'password' => $config['password'] ?? '',
            'charset' => $config['charset'] ?? 'utf8mb4',
            'collation' => $config['DBCollat'] ?? 'utf8mb4_general_ci',
            'prefix' => $config['DBPrefix'] ?? '',
        ], 'default');

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        self::$booted = true;
    }
}
