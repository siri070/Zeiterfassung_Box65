<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:42
 */
require_once ("../lib/validation.php");
require_once ("../repository/MitarbeiterRepository.php");

class mitarbeiterController
{

    public function index(){
        $view = new View('admin_mitarbeiterVerwaltung');
        $view->title = 'Mitarbeiter';
        $view->heading = 'Mitarbeiter';
        $mitarbeiterRepository = new MitarbeiterRepository();
        $view->alleMitarbeiter= $mitarbeiterRepository->readAll();
        if(isset($GLOBALS['fehler'])){
            $view->fehlermeldung= $GLOBALS['fehler'];
        }
        else{
            $view->fehlermeldung="";
        }
        $view->display();
    }


    public function login()
    {
        $mitarbeiterRepository = new MitarbeiterRepository();

        $view = new View('user_index');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }



    public function doLogin(){

        if ($_POST['send']){
            $benutzername = $_POST['benutzername'];
            $bnOK= false;
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
                    header('Location: /BWD/Zeiterfassung_Box65/public/Default');
                }
            }
            elseif(!$passwortStimmt){
                $_SESSION['fehler']= "Passwort ist falsch.";
                header('Location: /BWD/Zeiterfassung_Box65/public/Mitarbeiter/Login');

            }
            elseif (!$bnOk){
                $_SESSION['fehler']= "Benutzername zu lang. Max 4 Zeichen.";
                header('Location: /BWD/Zeiterfassung_Box65/public/Mitarbeiter/Login');

            }

        }


    }
    public function logout(){

       session_destroy();
        header('Location: /BWD/Zeiterfassung_Box65/public/Mitarbeiter/Login');

    }

    public function hinzufuegenView(){
        $view = new View('admin_MA_hinzu');
        $view->title = 'Mitarbeiter hinzufügen';
        $view->heading = 'Mitarbeiter hinzufügen';
        $view->display();
    }

    public function hinzufuegen(){
        if ($_POST['hinzufuegen']) {

            $vorname = $_POST['vorname'];


            $nachname = $_POST['name'];

            $susNR = $_POST['snr'];

            $passwort  = $_POST['passwort'];
            if($this->validationUser($vorname,$nachname,$susNR,$passwort))
               $mitarbeiterRepository = new MitarbeiterRepository();
               $mitarbeiterRepository->create($vorname, $nachname, $susNR, $passwort);
               header('Location: /BWD/Zeiterfassung_Box65/public/mitarbeiter');
           }
           else{
               header('Location: /BWD/Zeiterfassung_Box65/public/mitarbeiter/hinzufuegenView');
           }

        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)


    public function bearbeitenView(){
        $view = new View('admin_MA_bearbeiten');
        $view->title = 'Mitarbeiter bearbeiten';
        $view->heading = 'Mitarbeiter bearbeiten';
        $id = $_GET['id'];
        $mitarbeiterRepository = new MitarbeiterRepository();
        $view-> mitarbeiter = $mitarbeiterRepository->readById($id);
        $view->display();
    }

    public function bearbeiten(){

        if($_POST['speichern']){
            $id = $_GET['id'];
            $vorname = $_POST['vorname'];
            $nachname = $_POST['name'];
            $susNR = $_POST['snr'];
            $passwort  = $_POST['passwort'];
            if($this->validationUser($vorname,$nachname,$susNR,$passwort)){
                $mitarbeiterRepository = new MitarbeiterRepository();
                $mitarbeiterRepository ->updateByID($vorname, $nachname,$susNR,$passwort,$id);
                header('Location: /BWD/Zeiterfassung_Box65/public/mitarbeiter');
            }
            else{
                header('Location: /BWD/Zeiterfassung_Box65/public/Mitarbeiter/bearbeitenView?id='.$id);
            }

        }

    }
    public function validationUser($vorname,$nachname, $susNR,$passwort){
        $validation= new validation();
        $vornameOkL= $validation->laenge(50,$vorname);
        $vornameOkK= $validation->kuerze(2,$vorname);
        $nachnameOkL=$validation->laenge(50,$nachname);
        $nachnameOkK= $validation->kuerze(3,$nachname);
        $snrOKL= $validation->laenge(4,$susNR);
        $passwortOK= $validation->kuerze(8,$passwort);


        if($vornameOkK && $vornameOkL&& $nachnameOkK&& $nachnameOkL&&$snrOKL&&$passwortOK ){
            $_SESSION['fehler']= NULL;
            return true;
        }
         elseif (!$vornameOkL){
        $_SESSION['fehler']= "Der Vorname darf nicht länger als 50 Zeichen sein.";
        return false;
        }
        elseif (!$vornameOkK){
            $_SESSION['fehler']= "Der Vorname muss mindestens 2 Zeichen lang sein.";
            return false;
        }
        elseif (!$nachnameOkL){
            $_SESSION['fehler']= "Der Nachname darf nicht länger als 50 Zeichen sein.";
            return false;
        }
        elseif (!$nachnameOkK){
            $_SESSION['fehler']= "Der Nachname muss mindestens 3 Zeichen lang sein.";
            return false;
        }
        elseif (!$snrOKL){
            $_SESSION['fehler']= "Die S-NR darf nicht länger als 4 Zeichen sein.";
            return false;
        }
        elseif (!$passwortOK){
            $_SESSION['fehler']= "Das Passwort muss mindestens 8 Zeichen lang sein.";
            return false;
        }


    }
    public function loeschen(){
        if($_POST['delete']){
            $id = $_GET['id'];
            $mitarbeiterRepository = new MitarbeiterRepository();
            $mitarbeiterRepository->deleteById($id);

        }
        $view = new View('admin_mitarbeiterVerwaltung');
        $view->title = 'Mitarbeiter';
        $view->heading = 'Mitarbeiter';
        $mitarbeiterRepository = new MitarbeiterRepository();
        $view->alleMitarbeiter= $mitarbeiterRepository->readAll();
        $view ->meldung= "Sie haben einen Mitarbeiter gelöscht";
        $view->display();
    }
}