<article class="hreview open special">

            <div class="panel panel-default">
                <div class="panel-heading">Mitarbeiter</div>
                <div class="panel-body">
                    <?php $bearbeiten= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/bearbeitenView');
                      echo $bearbeiten->submit()->label('Bearbeiten')->name('bearbeiten');
                    $bearbeiten->end();
                    echo $meldung;
                    ?>
                </div>

            </div>
             <?php
                  $hinzufuegen= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/hinzufuegenView');
                  echo $hinzufuegen->submit()->label('Hinzufügen')->name('hinzufuegen');
                  $hinzufuegen->end();
             ?>
</article>