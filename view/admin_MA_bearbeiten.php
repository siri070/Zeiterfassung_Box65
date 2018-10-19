<?php
$form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/bearbeiten?id='.$mitarbeiter->id);
//echo $form->text()->label('Id')->name('id')->value($mitarbeiter->id);
echo $form->text()->label('Name')->name('name')->value($mitarbeiter->nachname);
echo $form->text()->label('Vorname')->name('vorname')->value($mitarbeiter->vorname);
echo $form->text()->label('S-NR.')->name('snr')->value($mitarbeiter->benutzername);
echo $form->text()->label('Passwort')->name('passwort');
echo $form->submit()->label('Speichern')->name('speichern');
$form->end();

$delete = new Form($GLOBALS ['appurl'] . '/Mitarbeiter/loeschen?id='.$mitarbeiter->id);
echo $delete ->submit()->label('Löschen')->name('delete');
$delete->end();
?>