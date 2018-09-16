<?php
$form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/bearbeiten');
echo $form->text()->label('Name')->name('name');
echo $form->text()->label('Vorname')->name('vorname');
echo $form->text()->label('S-NR.')->name('snr');
echo $form->text()->label('Passwort')->name('passwort');
echo $form->submit()->label('Speichern')->name('speichern');
$form->end();

$delete = new Form($GLOBALS ['appurl'] . '/Mitarbeiter/loeschen');
echo $delete ->submit()->label('Löschen')->name('delete');
$delete->end();
?>