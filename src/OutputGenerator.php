<?php
namespace Gazatem\Glog;

class OutputGenerator{

  static function get_message($logMessage){
    try{
      $logMessage = json_decode($logMessage);
      if (isset($logMessage->message)){
        echo $logMessage->message;
      }else{
        echo $logMessage[0];
      }
    }catch(Exception $ex){
       echo $ex->getMessage();
    }
  }
}
