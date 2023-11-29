<?php 
include("model_param.php");
$params = getParam();
?>

<footer>



    <form action="traitement_newsletter.php?valeur=true" method="post">
        
            <?php

            if (isset($_SESSION['idcli']) && !empty($_SESSION['idcli'])) {

                ?> <button type="submit" name="newsletter_action"><?php

                if (isset($_SESSION['is_subscribed']) && $_SESSION['is_subscribed']) {
                    echo 'Se désabonner de la newsletter';
                } else {
                    echo "S'abonner à la newsletter";
                }
            }
                            ?>
        </button>
    </form>


    <div id="auto-email">
        <p>
            ATELIER NINA CREATIONS
        </p>
        <p>
            Contact :
            <a data-auto-recognition="true" href="mailto:ATELIERNINACREATIONS@GMAIL.COM">ATELIERNINACREATIONS@GMAIL.COM</a>
        </p>
        <p><?php echo $params['TEL_ENTREPRISE']  ?></p>
        </p>
    </div>
    <a href="../"></a>


</footer>