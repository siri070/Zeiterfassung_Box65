<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:43
 */
require_once ("../repository/MitarbeiterRepository.php");
require_once ("../repository/ArbeitsendeRepository.php");
require_once ("../repository/ZeiterfassungRepository.php");
require_once ("../lib/validation.php");
class ArbeistendeController
{

    public function index(){


        $view = new View('member_endtime');
        $view->title = 'Arbeitsende';
        $view->heading = 'Arbeitsende';
        $view->display();

    }
    public function login()
    {

        $view = new View('ende');
        $view->title = 'Login Ende';
        $view->heading = 'Login Ende';
        $view->display();
    }



    public function doLogin(){

        if ($_POST['send']){
            $bnOk= false;

            $benutzername = $_POST['benutzername'];
            $validation= new validation();
            if($validation->laenge(4,$benutzername)){
                $bnOk= true;
            }
            $passwort = $_POST['passwort'];

            $mitarbeiterRepository = new MitarbeiterRepository();

            $mitarbeiter=$mitarbeiterRepository->readByKuerzel($benutzername);
            $passwortStimmt= password_verify($passwort, $mitarbeiter->passwort);

            if($passwortStimmt && $bnOk){
                $_SESSION['fehler']= NULL;
                $_SESSION['id']= $mitarbeiter->id;
                if($mitarbeiter->admin == 1){
                    $_SESSION['admin']=1;
                    header('Location: /BWD/Zeiterfassung_Box65/public/Zeiterfassung/adminIndex');
                }
                else{
                    $_SESSION['admin']=NULL;
                    $this->eintragEnde($mitarbeiter->id);
                    header('Location: /BWD/Zeiterfassung_Box65/public/Arbeistende');

                }
            }
            elseif(!$passwortStimmt){
                $_SESSION['fehler']= "Passwort ist falsch.";
                header('Location: /BWD/Zeiterfassung_Box65/public/Arbeistende/Login');

            }
            elseif (!$bnOk){
                $_SESSION['fehler']= "Benutzername zu lang. Max 4 Zeichen.";
                header('Location: /BWD/Zeiterfassung_Box65/public/Arbeistende/Login');

            }

        }


    }
    public function eintragEnde($id){
        $arbeitsEndeRepository = new ArbeitsendeRepository();
        $id_eintrag= $arbeitsEndeRepository->create($id);
        $this->eintragZeiterfassung($id_eintrag, $id);
    }
    public function eintragZeiterfassung($idAE, $mid){
        $zeitRepository = new ZeiterfassungRepository();
        $zeitRepository->create($mid,$_SESSION['ABid'],$idAE);

    }
}