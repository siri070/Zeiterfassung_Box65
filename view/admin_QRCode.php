<article class="hreview open special">
    <?php
    $qrCodeGenerieren= new Form($GLOBALS ['appurl'] . '/QRCode/doGenerieren');?>
         <input type="radio" name="art" value="Beginn"> Arbeitsbeginn<br>
        <input type="radio" name="art" value="Ende"> Arbeistende<br>
    <?php
    echo $qrCodeGenerieren->submit()->label('Generieren')->name('generieren');
    $qrCodeGenerieren->end();
    ?>

</article>