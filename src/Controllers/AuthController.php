<?php

namespace Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Classes\Main;
use helper\DataService;
use helper\generateJWT;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;
use helper\JwtHelper;
use Asm89\Stack\Cors;
use Asm89\Stack\CorsService;

class AuthController{

  public function login(Request $request, Response $response, Main $app){
    
    $cors = new CorsService([
      'allowedHeaders'         => ['x-allowed-header', 'x-other-allowed-header'],
      'allowedMethods'         => ['DELETE', 'GET', 'POST', 'PUT'],
      'allowedOrigins'         => ['http://localhost'],
      'allowedOriginsPatterns' => ['/localhost:\d/'],
      'exposedHeaders'         => false,
      'maxAge'                 => false,
      'supportsCredentials'    => false,
  ]);
  
  $cors->addActualRequestHeaders($response, $request);
  $cors->handlePreflightRequest($request);
  $cors->isActualRequestAllowed($request);
  $cors->isCorsRequest($request);
  $cors->isPreflightRequest($request);
  
    $req = json_decode($request->getContent(), true);
    $token = null;
    $uid = null;
    $name = null;
    
    $dbService = new DataService();
    $jwt = new JwtHelper();
    $dbUser=$dbService->queryUser($req['email'],$app['dbs']['pruebas']);

    if(!$dbUser){
      $ok = false;
      $msg = "No existe usuario con este correo";
      return new JsonResponse( compact("ok", "msg") );
    }else{
      
      $pass=$dbService->findPassUser($req['email'],$app['dbs']['pruebas']);
      
      if(password_verify($req['password'], $pass[0]['PASS'])) {
        $uid = $dbService->findUserId($req['email'],$app['dbs']['pruebas']);
        $name = $pass[0]['NAME'];
        $ok = true;
        $token = $jwt->generateJWT($req);
      }else{
        $ok = false;
        $msg = "La contraseña es incorrecta";
      }
    }
    return new JsonResponse( compact("ok","uid","name","token") );

  }

  public function register(Request $request, Main $app){
    try{
      $req = json_decode($request->getContent(), true);
      $name = $req['name'];

      $dbService = new DataService();
      $jwt = new JwtHelper();
      $dbUser=$dbService->queryUser($req['email'],$app['dbs']['pruebas']);

      if($dbUser){
        $ok = false;
        $msg = "El usuario ya existe con ese correo";
        return new JsonResponse( compact("ok", "msg") );
      }else{
        $req['password'] = password_hash($req['password'], PASSWORD_BCRYPT);
        //var_dump($hashed_password);
        $token = $jwt->generateJWT($req);
        $saveUser = $dbService->registerUser($req,$app['dbs']['pruebas']);
        $uid = $dbService->findUserId($req['email'],$app['dbs']['pruebas']);
        $ok = true;
        return new JsonResponse( compact("ok","uid","name","token") );

      }
    }catch(\Exception $e){
      //var_dump($e);
      //$data = array('mensajeIniCadena' => substr($e->getMessage(), 0, 37),'mensajeFinCadena' => substr($e->getMessage(), -26));
      //return new JsonResponse( compact("data") );
    } 
  }
  
}