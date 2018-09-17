<article class="hreview open special">


    <?php
    $form= new Form($GLOBALS ['appurl'] . '/Arbeitsbeginn'); ?>
        Benutzername:<br>
        <input type="benutzername" name="benutzername"><br><br>

        Passwort:<br>
        <input type="password" name="passwort"><br><br>

    <?php
        echo $form->submit()->label("Anmelden")->name('anmeldung');
        $form->end();
        ?>

</article>