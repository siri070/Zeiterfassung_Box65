<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:43
 */

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
        $view->display();
    }
    public function suchen(){
        $view = new View('admin_zeituebersicht');
        $view->title = 'Zeiterfassungen';
        $view->heading = 'Zeiterfassungen';
        $view->display();
}

}