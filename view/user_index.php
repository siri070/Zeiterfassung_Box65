<article class="hreview open special">


    <?php
    $form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/doLogin'); ?>
        Benutzername:<br>
        <input type="benutzername" name="benutzername"><br><br>

        Passwort:<br>
        <input type="password" name="passwort"><br><br>

    <?php
   /* $form= new Form($GLOBALS ['appurl'] . '/Mitarbeiter/doLogin');
    echo $form->text()->label('Benutzername')->name('benutzername');
    echo $form->text()->label('Passwort')->name('passwort');*/
        echo $form->submit()->label("Login")->name('send');
        $form->end();
        ?>

</article>