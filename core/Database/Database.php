<?php

namespace Core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function connection($host, $database, $username, $password, $driver = 'mysql')
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => $driver,
            'host'      => $host,
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }

}
