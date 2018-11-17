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
            $benutzername = $_POST['benutzername'];
            $passwort = $_POST['passwort'];

            $mitarbeiterRepository = new MitarbeiterRepository();

            $mitarbeiter=$mitarbeiterRepository->readByKuerzel($benutzername);
            $passwortStimmt= password_verify($passwort, $mitarbeiter->passwort);

            if($passwortStimmt){
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
            else{
                $GLOBALS['fehler']= "Passwort ist falsch.";
                header('Location: /BWD/Zeiterfassung_Box65/public/Mitarbeiter/Login');

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