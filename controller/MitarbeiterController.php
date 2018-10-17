<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:42
 */
require_once ("../repository/MitarbeiterRepository.php");

class mitarbeiterController
{


    public function index(){
        $view = new View('admin_mitarbeiterVerwaltung');
        $view->title = 'Mitarbeiter';
        $view->heading = 'Mitarbeiter';
        $mitarbeiterRepository = new MitarbeiterRepository();
        $view->alleMitarbeiter= $mitarbeiterRepository->readAll();
        $view->meldung="";
        $view->display();
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


           $mitarbeiterRepository = new MitarbeiterRepository();
           $mitarbeiterRepository->create($vorname, $nachname, $susNR, $passwort);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /BWD/Zeiterfassung_Box65/public/mitarbeiter');
    }

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
            $id = $_POST['id'];
            $vorname = $_POST['vorname'];
            $nachname = $_POST['name'];
            $susNR = $_POST['snr'];
            $passwort  = $_POST['passwort'];
            $mitarbeiterRepository = new MitarbeiterRepository();
            $mitarbeiterRepository ->updateByID($vorname, $nachname,$susNR,$passwort,$id);

        }
        header('Location: /BWD/Zeiterfassung_Box65/public/mitarbeiter');
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