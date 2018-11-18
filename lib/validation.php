<?php
/**
 * Created by PhpStorm.
 * User: irisb
 * Date: 17.11.2018
 * Time: 16:10
 */

class validation
{
    public function laenge( $max,$string){
        if(strlen($string)>$max){
            return false;
        }
        elseif (strlen($string)<=$max){
            return true;
        }
    }
    public function kuerze($min, $string){
        if(strlen($string)>=$min){
            return true;
        }
        elseif (strlen($string)<min){

            return false;
        }
    }

}