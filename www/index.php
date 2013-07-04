<?php

require __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\SessionServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

define('SESSION_KEY', 'some_key');

$app = new Application();

$app->register(new SessionServiceProvider());

/**
 * Before middleware
 */
$app->before(function (Request $request) use ($app) {
//    $app['session']->start();
});

/**
 * Main route
 */
$app->get('/', function () use ($app) {
    return sprintf('Main<br /><br />Session: %s', $app['session']->get(SESSION_KEY));
});

/**
 * Set session value route
 */
$app->get('/set', function () use ($app) {
    $app['session']->set(SESSION_KEY, 'some_value');

    return sprintf('Set<br /><br />Session: %s', $app['session']->get(SESSION_KEY));
});

/**
 * Session invalidate route
 */
$app->get('/invalidate', function () use ($app) {
    $app['session']->invalidate();

    return sprintf('Set<br /><br />Session: %s', $app['session']->get(SESSION_KEY));
});

$app->run();
