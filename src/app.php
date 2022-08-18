<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\RoutingServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new RoutingServiceProvider());
$app->register(new SessionServiceProvider(), array(
    'session.storage.save_path' => dirname(__DIR__) . '/tmp/sessions'
));
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
});

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array(
        'pruebas'  => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'port'      => 3306,
            'dbname'    => 'gizlo',
            'user'      => 'root',
            'password'  => null,
        ),
    ),
));

$app['config.HomeDir'] = "gizlo/";

return $app;
