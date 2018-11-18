<?php
$form= new Form($GLOBALS ['appurl'] . '/Zeiterfassung/suchen');
echo $form->text()->label('Vorname')->name('name');
echo $form->text()->label('S-NR.')->name('snr');
echo $form->submit()->label('suchen')->name('suchen');
$form->end();
?>
<?php if (empty($alleZeiten)): ?>
    <div class="dhd" style="padding-bottom: 100%;">
        <h2 class="item title"> Es konnten keine Zeiten gefunden werden.  </h2>
    </div>
<?php else: ?>

        <table>
        <tr>
        <th style="width: 11em">Nachname              </th>
        <th style="width: 11em">Vorname               </th>
        <th style="width: 11em">Arbeitsbeginn         </th>
        <th style="width: 11em">Arbeitsende           </th>
        <th style="width: 11em">Arbeitszeit           </th></tr>


    <?php foreach ($alleZeiten as $Zeit):
        //Zeitunterschied berechnen
        List($Datum,$uhrZeit ) = explode(" ",$Zeit->beginn);
        List($Stunde,$Minute)= explode(":",$uhrZeit);

        List($Datum2, $uhrzeit2)= explode(" ",$Zeit->ende);
        List($Stunde2,$Minute2)= explode(":",$uhrzeit2);
        $Stunden = (int)$Stunde2-(int)$Stunde;
        $Minuten= (int)$Minute2-(int)$Minute;?>
        <tr> <td>
                <?= $Zeit->nachname."   ".""?>
            </td>
            <td>
                <?= $Zeit->vorname."   ".""?>
            </td>
            <td>
                <?= $Zeit->beginn."   ".""?>
            </td>
            <td>
                <?= $Zeit->ende."   ".""?>
            </td>
            <td>
                <?= $Stunden."h ".$Minuten."min"?>
            </td><?php

            ?>
        </tr>


    <?php endforeach ?>
<?php endif;

?>
        </table>
