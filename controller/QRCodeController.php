<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 16:04
 */
//include "phpqrcode/qrlib.php";
class QRCodeController
{

    public function index(){
        $view = new View('admin_QRCode');
        $view->title = 'QR-Code erstellen';
        $view->heading = 'QR-Code erstellen';
        $view->display();
    }
    public function generieren(){
        $view = new View('admin_ qrCodeGeneriert');
        $view->title = 'QR-Code';
        $view->heading = 'QR-Code';
        $view->display();
    }
    
    public function doGenerieren(){
        if($_POST['generieren']){
            $wann= $_POST['art'];
            $datum= "12";
                if($wann=="Beginn"){
                    //Code für den QR Code generierung

                }
                if($wann=="Ende"){
                    //code für die QRCode genrierung
                }
        }

    }
}