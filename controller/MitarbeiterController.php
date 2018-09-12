<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:42
 */

class mitarbeiterController
{
    public function index(){
        $view = new View('admin_mitarbeiterVerwaltung');
        $view->title = 'Mitarbeiter';
        $view->heading = 'Mitarbeiter';
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

    }
    public function bearbeitenView(){
        $view = new View('admin_MA_bearbeiten');
        $view->title = 'Mitarbeiter bearbeiten';
        $view->heading = 'Mitarbeiter bearbeiten';
        $view->display();
    }
    public function bearbeiten(){

    }
    public function loeschen(){
        $view = new View('admin_mitarbeiterVerwaltung');
        $view->title = 'Mitarbeiter';
        $view->heading = 'Mitarbeiter';
        $view ->meldung= "Sie haben einen Mitarbeiter gelöscht";
        $view->display();
    }
}