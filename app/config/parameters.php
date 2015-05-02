<?php

$container->setParameter('database_driver', 'pdo_mysql');
if (php_sapi_name() == 'cli') {
    $container->setParameter('database_host', '127.0.0.1');
} else {
    $container->setParameter('database_host', 'lpfactorydb');
}
$container->setParameter('database_port', '');
$container->setParameter('database_name', 'lpfactory');
$container->setParameter('database_user', 'root');
$container->setParameter('database_password', 'lpfactory');
