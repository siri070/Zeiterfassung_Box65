<article class="hreview open special">

            <div class="panel panel-default">
                <div class="panel-heading">Mitarbeiter</div>
                <div class="panel-body">
                    <?php if (empty($alleMitarbeiter)): ?>
                        <div class="dhd" style="padding-bottom: 100%;">
                            <h2 class="item title"> Sie haben noch keine Mitarbeiter </h2>
                        </div>
                    <?php else: ?>

                        <?php foreach ($alleMitarbeiter as $mitarbeiter): ?>
                            <p><?php echo $mitarbeiter->vorname."  ";
                                echo $mitarbeiter->nachname."  " ;
                                echo $mitarbeiter->benutzername." "; ?></p>

                            <?php $bearbeiten= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/bearbeitenView?id='.$mitarbeiter->id );
                            echo $bearbeiten->submit()->label('Bearbeiten')->name('bearbeiten');
                            $bearbeiten->end();

                            ?>
                        <?php endforeach ?>
                    <?php endif;

                     ?>

                </div>

            </div>

             <?php

                  $hinzufuegen= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/hinzufuegenView');
                  echo $hinzufuegen->submit()->label('Hinzufügen')->name('hinzufuegen');
                  $hinzufuegen->end();
             ?>
</article>