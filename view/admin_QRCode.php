<article class="hreview open special">

         <input type="radio" name="art" value="Beginn"> Arbeitsbeginn<br>
        <input type="radio" name="art" value="Ende"> Arbeistende<br>
    <?php
    $qrCodeGenerieren= new Form($GLOBALS ['appurl'] . '/QRCode/generieren');
    echo $qrCodeGenerieren->submit()->label('Generieren')->name('generieren');
    $qrCodeGenerieren->end();
    ?>

</article>