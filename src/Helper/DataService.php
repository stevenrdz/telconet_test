<?php

namespace helper;
use Exception;

class DataService{

  private $tables = array(     
    'users'            => 'GIZLO.USERS',
    'ticket'       => 'GIZLO.TICKET',
    'ticket_detail'       => 'GIZLO.TICKET_DETAIL',
  );

  public function consultaUsuario($dbService)
    {
        $sql = "SELECT * FROM ".$this->tables['users'];
        $row = $dbService->fetchAll($sql);    

        if(is_array($row) and isset($row) and count($row)>0 ){
            return array("res" => $row, "bool" => true);
        }else{
            return false;
        }
    }

}