<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.09.2018
 * Time: 15:43
 */

class ArbeitsbeginnController
{
    public function index(){
        $view = new View('member_starttime');
        $view->title = 'Arbeitsbeginn';
        $view->heading = 'Arbeitsbeginn';
        $view->meldung="";
        $view->display();
    }
}