<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 16:04
 */
include "../lib/phpqrcode/qrlib.php";
class QRCodeController
{

    public function index(){
        $view = new View('admin_QRCode');
        $view->title = 'QR-Code erstellen';
        $view->heading = 'QR-Code erstellen';
        if(isset($GLOBALS['fehler'])){
            $view->fehlermeldung= $GLOBALS['fehler'];
        }
        else{
            $view->fehlermeldung="";
        }
        $view->display();
    }
    public function generieren($bildname){
        $view = new View('admin_ qrCodeGeneriert');
        $view->title = 'QR-Code';
        $view->heading = 'QR-Code';
        $view->bild= $bildname;
        $view->display();
    }
    
    public function doGenerieren(){
        if($_POST['generieren']){
            $wann= $_POST['art'];
            $datum = time();
                    if($wann=="Beginn"){

                        $bildname= "qrCode".$datum."AB.png";
                        QRcode::png("Localhost/".$GLOBALS['appurl']."/Arbeitsbeginn/Login",$bildname,"L",5,5);
                        $this->generieren($bildname);

                    }
                    if($wann=="Ende"){
                        //code für die QRCode genrierung
                        $bildname= "qrCode".$datum."AE.png";
                        QRcode::png("Localhost/".$GLOBALS['appurl']."/Arbeistende/Login",$bildname,"L",5,5);
                        $this->generieren($bildname);
                    }



        }

    }
}