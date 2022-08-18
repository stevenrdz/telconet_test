<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Helper\DataService;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function (Request $request) use ($app) {
    
    $dataService = new DataService();
    $data['consulta']= $dataService->consultaUsuario($app['dbs']['pruebas']);

    echo '<pre>';
    var_dump(array("login" =>$data));
    echo '</pre>';
    return $app['twig']->render('index.html.twig');
})->bind('homepage');

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
