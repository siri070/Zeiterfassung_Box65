<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:43
 */
require_once '../repository/ZeiterfassungRepository.php';
require_once '../repository/MitarbeiterRepository.php';
require_once '../lib/validation.php';
class ZeiterfassungController
{
    public function index(){
        $view = new View('user_index');
        $view->title = 'Zeiterfassen';
        $view->heading = 'Zeiterfassen';
        $view->display();

    }
    public function adminIndex(){
        $view = new View('admin_zeituebersicht');
        $view->title = 'Zeiterfassungen';
        $view->heading = 'Zeiterfassungen';
        $zeitRepository = new ZeiterfassungRepository();
        $view->alleZeiten= $zeitRepository->getTimeOfAll();
        $view->display();
    }
    public function suchen(){
        if($_POST['suchen']){
            $validation = new validation();
            $Name= $_POST['name'];

            $sNR= $_POST['snr'];

            if(empty($Name)){
                if($validation->laenge(4,$sNR)){
                    $_SESSION['fehler']=NULL;
                    $MitarbeiterRepository = new MitarbeiterRepository();
                    $mitarbeiter= $MitarbeiterRepository->readBySnr($sNR);
                    $this->suchenView($mitarbeiter->id);
                }
                else{
                    $_SESSION['fehler']= "Die S-Nr kann nicht länger als 4 Zeichen sein";
                    $this->adminIndex();
                }
            }
            elseif (empty($sNR)){
                if($validation->kuerze(2,$Name)) {
                    $_SESSION['fehler']=NULL;
                    $MitarbeiterRepository = new MitarbeiterRepository();
                    $mitarbeiter = $MitarbeiterRepository->readByName($Name);

                    $this->suchenView($mitarbeiter->id);
                }
                else{
                    $_SESSION['fehler']= "Der Vorname muss mindestens 2 Zeichen lang sein";
                    $this->adminIndex();
                }
            }

        }

    }
    public function suchenView($mid){
        $view = new View('admin_zeituebersicht');
        $view->title = 'Zeiterfassungen';
        $view->heading = 'Zeiterfassungen';
        $zeitRepository = new ZeiterfassungRepository();
        $view->alleZeiten= $zeitRepository->getTimeOfOne($mid);
        $view->display();
    }


}