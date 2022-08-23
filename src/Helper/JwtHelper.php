<?php

namespace helper;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper{
  public function generateJWT($data){
    $key = 'est0deb3DeSERComplic4d02080';
    
    $jwt = JWT::encode($data, $key, 'HS256');
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    return $jwt;
  }
}

