<?php
$form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/bearbeiten');
echo $form->text()->label('Name')->name('name')->value();
echo $form->text()->label('Vorname')->name('vorname')->value();
echo $form->text()->label('S-NR.')->name('snr')->value();
echo $form->text()->label('Passwort')->name('passwort')->value();
echo $form->submit()->label('Speichern')->name('speichern');
$form->end();

$delete = new Form($GLOBALS ['appurl'] . '/Mitarbeiter/loeschen');
echo $delete ->submit()->label('Löschen')->name('delete');
$delete->end();
?>