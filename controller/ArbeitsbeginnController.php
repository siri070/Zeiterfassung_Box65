<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:43
 */
require_once ("../repository/MitarbeiterRepository.php");
require_once ("../repository/ArbeitsbeginnRepository.php");

class ArbeitsbeginnController
{
    public function index(){
        $view = new View('member_starttime');
        $view->title = 'Arbeitsbeginn';
        $view->heading = 'Arbeitsbeginn';
        $view->display();

    }
    public function login()
    {
        $mitarbeiterRepository = new MitarbeiterRepository();

        $view = new View('beginn');
        $view->title = 'Login Beginn';
        $view->heading = 'Login Beginn';
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
                    $this->eintrag($mitarbeiter->id);
                    header('Location: /BWD/Zeiterfassung_Box65/public/Arbeitsbeginn');
                }
            }
            else{
                $GLOBALS['fehler']= "Passwort ist falsch.";
                header('Location: /BWD/Zeiterfassung_Box65/public/Mitarbeiter/Login');

            }

        }


    }
    public function eintrag($id){
        $arbeitsBeginnRepository = new ArbeitsbeginnRepository();
        $_SESSION['ABid']=$arbeitsBeginnRepository->create($id);
    }
}