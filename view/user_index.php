<article class="hreview open special">

    <?php
    $form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/doLogin');
    echo $form->text()->label('Benutzername')->name('benutzername');
    echo $form->passwort()->label('Passwort')->name('passwort');
        echo $form->submit()->label("Login")->name('send');
        $form->end();
        ?>

</article>