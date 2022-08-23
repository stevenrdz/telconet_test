<?php

namespace helper;
use Exception;

class DataService{

  private $tables = array(     
    'users'            => 'GIZLO.USERS',
    'ticket'       => 'GIZLO.TICKET',
    'ticket_detail'       => 'GIZLO.TICKET_DETAIL',
  );

  public function queryUser($email,$dbService){
    $sql = "SELECT * FROM ".$this->tables['users'];
    $sql .= " WHERE EMAIL ='".$email."'";
    $row = $dbService->fetchAll($sql);   
    
    if(is_array($row) and isset($row) and count($row)>0 ){
      return true;
    }else{
      return false;
    }
  }

  public function registerUser($data,$dbService){
    try{
      $sql = "INSERT INTO  ".$this->tables['users']." (EMAIL,PASS, NAME, SURNAME, CREATED_DATE, UPDATED_DATE, ID_ROL)";
      $sql .= "VALUES('".$data['email']."','".$data['password']."', '".$data['name']."',
      '".$data['surname']."','".date('Y-m-d')."','".date('Y-m-d')."','".$data['id_rol']."')";
      $dbService->executeUpdate($sql);
      $dbService->close();
    }catch(\Exception $e){
      //Agregar Excepción
      var_dump($e->getMessage());
    }
  }

  public function findUserId($email, $dbService){
    $sql = "SELECT * FROM ".$this->tables['users'];
    $sql .= " WHERE EMAIL ='".$email."'";
    $row = $dbService->fetchAll($sql);  
    return $row[0]['ID'];
  }

  public function findPassUser($email, $dbService){
    $sql = "SELECT * FROM ".$this->tables['users'];
    $sql .= " WHERE EMAIL ='".$email."'";
    $row = $dbService->fetchAll($sql);  
    return $row;
  }

}