<?php

return array(
    'db' => array(
        'driver' => 'Pdo_Mysql',
        'database' => 'zendbase',
        'username' => 'root',
        'password' => '12345'
    ),

    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '12345',
                    'dbname'   => 'zendbase',
                )
            )
        )
    ),
);
