<?php

/*
 * Die index.php Datei ist der Einstiegspunkt des MVC. Hier werden zuerst alle
 * vom Framework benötigten Klassen geladen und danach wird die Anfrage dem
 * Dispatcher weitergegeben.
 *
 * Wie in der .htaccess Datei beschrieben, werden alle Anfragen, welche nicht
 * auf eine bestehende Datei zeigen hierhin umgeleitet.
 */
$GLOBALS['appurl'] = '/BWD/Zeiterfassung_Box65/public';
$GLOBALS['numAppurlFragments'] = 3;
session_start();
$_SESSION['admin']=1;
require_once '../lib/Dispatcher.php';
require_once '../lib/formbuilder/FormBuilder.php';
require_once '../lib/View.php';

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
