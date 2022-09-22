<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 6/20/2020
 * Time: 11:47 AM
 */

namespace Absoft\Line\App\Pager;

use Application\conf\Configuration;

class Alert {

    public static $alert = [
        // "success" => [
        //     "message" => "",
        //     "class" => "",
        // ],
        // "info" => [
        //     "message" => "",
        //     "class" => ""
        // ],
        // "error" => [
        //     "message" => "",
        //     "class" => ""
        // ]
    ];

    public static function sendSuccessAlert($message){
        self::$alert["success"]["message"] = $message;
    }

    public static function sendInfoAlert($message){
        self::$alert["info"]["message"] = $message;
    }

    public static function sendErrorAlert($message){
        self::$alert["error"]["message"] = $message;
    }

    public static function displayAlert(){

        $message = "";
        $class_name = "";

        if(isset(self::$alert["success"]["message"]) && self::$alert["success"]["message"] != ""){

            $class_name = self::getSuccessClassName();
            $message = self::$alert["success"]["message"];

            self::$alert["success"]["message"] = "";

        }

        if(isset(self::$alert["info"]["message"]) && self::$alert["info"]["message"] != ""){

            $class_name = self::getinfoClassName();
            $message = self::$alert["info"]["message"];

            self::$alert["info"]["message"] = "";

        }

        if(isset(self::$alert["error"]["message"]) && self::$alert["error"]["message"] != ""){

            $class_name = self::getErrorClassName();
            $message = self::$alert["error"]["message"];

            self::$alert["error"]["message"] = "";

        }

        print '
            <div class="'.$class_name.'">
            '.$message.' 
            </div>
        ';

    }

    public static function setSuccessClassName($name){
        self::$alert["success"]["class_name"] = $name;
    }

    public static function setErrorClassName($name){
        self::$alert["error"]["class_name"] = $name;
    }

    public static function setInfoClassName($name){
        self::$alert["info"]["class_name"] = $name;
    }

    public static function getSuccessClassName(){

        if(!isset(self::$alert["success"]["class_name"]) || empty(self::$alert["success"]["class_name"])){
            self::$alert["success"]["class_name"] = Configuration::$alert_setup["success_class_name"];
        }

        return self::$alert["success"]["class_name"];

    }

    public static function getErrorClassName(){

        if(!isset(self::$alert["error"]["class_name"]) || empty(self::$alert["error"]["class_name"])){
            self::$alert["error"]["class_name"] = Configuration::$alert_setup["error_class_name"];
        }

        return self::$alert["error"]["class_name"];

    }

    public static function getInfoClassName(){

        if(!isset(self::$alert["info"]["class_name"]) || empty(self::$alert["info"]["class_name"])){
            self::$alert["info"]["class_name"] = Configuration::$alert_setup["info_class_name"];
        }

        return self::$alert["info"]["class_name"];

    }

}
