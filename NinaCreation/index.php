<!DOCTYPE html>
<html lang="fr">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" sizes="192x192" href="img/logo_sans_fond.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylefooter.css">

    <script src="./bootstrap/js/bootstrap.js"></script>

    <title>Nina Créations</title>
</head>
<?php include("./include/header.php") ?>

<body>
    <section-prod>
        <p>NOS MEILLEURS PRODUITS</p>
        <?php
        require_once("./conn_phpmyadmin.php");
        $db = conn();

        $reqprods = $db->prepare("SELECT DISTINCT PRODUIT.ID_PRODUIT,NOM_PRODUIT FROM PRODUIT 
JOIN TYPE_PROD ON TYPE_PROD.ID_TYPEPROD = PRODUIT.ID_TYPEPROD 
JOIN CATEGORIE_PROD ON CATEGORIE_PROD.ID_CATEGORIEPROD = PRODUIT.ID_CATEGORIEPROD
JOIN AVIS on AVIS.ID_PRODUIT = PRODUIT.ID_PRODUIT where NOTE_AVIS = 5  AND PRODUIT.STATUT_PROD = 'disponible' limit 6");

        $reqprods->execute();
        echo "<div id='prod'>";
        $index = 0;
        while ($prod = $reqprods->fetch()) {
            $imgprod = $db->prepare("SELECT IMAGE_PROD from IMG_PROD where ID_PRODUIT = :id limit 1");
            $imgprod->execute(["id" => $prod["ID_PRODUIT"]]);
            $IMG = $imgprod->fetch();
        ?>
            <div>

                <?php
                if (isset($_SESSION["idcli"]) && !empty($_SESSION["idcli"])) {
                    $favprodcli = $db->prepare("select count(*) from FAVORI where ID_CLIENT = :cli and ID_PRODUIT = :prod");
                    $favprodcli->execute(["cli" => $_SESSION["idcli"], "prod" => $prod["ID_PRODUIT"]]);
                    $fav = $favprodcli->fetch();
                    if ($fav["count(*)"] == 1) {
                ?>
                        <div>
                            <a class="lienfav" href="javascript:void(0);" onclick="addfav(<?= $index ?>)">
                                <img id="imgfav<?= $index ?>" class="favnonfav" src="./img/fav.png">
                            </a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div>
                            <a class="lienfav" href="javascript:void(0);" onclick="addfav(<?= $index ?>)">
                                <img id="imgfav<?= $index ?>" class="favnonfav" src="./img/nonfav.png">
                            </a>
                        </div>

                    <?php }
                    ?>
                    <input type="hidden" id="idprod<?= $index ?>" value="<?= $prod["ID_PRODUIT"] ?>">
                <?php
                }
                ?>
                <a style="z-index: 1;" href="./produit.php?idprod=<?= $prod["ID_PRODUIT"] ?>"><img src="<?= $IMG["IMAGE_PROD"] ?>"></a>
                <p><?= $prod["NOM_PRODUIT"] ?></p>
            </div>
        <?php
            $index++;
        }
        echo "</div>";
        ?>
    </section-prod>

</body>
<?php include("./include/footer.php"); ?>

<script>
    function addfav(index) {
        var image = document.getElementById("imgfav" + index);
        var idprod = document.getElementById("idprod" + index);
        if (image.src.endsWith("nonfav.png")) {
            image.src = "./img/fav.png";
            window.location.href = "traitement.php?value=ajoutfav&idprod=" + idprod.value;
        } else {
            image.src = "./img/nonfav.png";
            window.location.href = "traitement.php?value=delfav&idprod=" + idprod.value;
        }
    }
</script>

</html>