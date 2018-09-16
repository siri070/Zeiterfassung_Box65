<?php
    $form= new Form($GLOBALS ['appurl'] . '/Zeiterfassung/suchen');
    echo $form->text()->label('Name')->name('name');
echo $form->text()->label('S-NR.')->name('snr');
    echo $form->submit()->label('suchen')->name('suchen');
    $form->end();
?>
<div class="panel panel-default">
    <div class="panel-heading">Erfasste Zeiten</div>
    <div class="panel-body">

    </div>
</div>