<?php
$form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/hinzufuegen');
echo $form->text()->label('Name')->name('name');
echo $form->text()->label('Vorname')->name('vorname');
echo $form->text()->label('S-NR.')->name('snr');
echo $form->text()->label('Passwort')->name('passwort');
echo $form->submit()->label('hinzufügen')->name('hinzufuegen');
$form->end();
?>