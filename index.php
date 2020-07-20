<?php

$data=  new PDO('mysql:host=localhost;dbname=test_zora', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    /**
     * inserer un membre
     */
    if($_POST && $_POST['nom']){
        $insertMembre = $data->prepare("INSERT INTO membre (id_membre, nom) VALUES (:id_membre, :nom)");
        $insertMembre->bindValue(":id_membre", $_POST['id_membre'], PDO::PARAM_INT);
        $insertMembre->bindValue(":nom", $_POST['nom'], PDO::PARAM_STR);
        $insertMembre->execute();
    }
    /**
     * Affichage des membres
     */
    $membres = $data->prepare("SELECT * FROM membre");
    $membres->execute();

    


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">
        <title>wildcodeschool</title>
    </head>
    <body>
        <div class="container">
            <header>
            <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
                <h1>Les Argonautes</h1>
            </header>
            <main>
                <section class="save">
                    <h2>Ajouter un(e) Argonaute</h2>
                    <form method="post" action="">
                        <input type="hidden" name="id_membre">
                        <label for="nom">Nom de l'Argonaute</label>
                        <div>
                            <input type="text" name="nom" placeholder="Charalampos">
                            <input type="submit" value="Envoyer">
                        </div>
                    </form>
                </section>
                    
              <?php  if($membres->rowCount() > 0): ?>
                <h2>Membres de l'équipage</h2>   
                <section class="show">
                    <?php foreach($membres as $membre): ?>
                    <div><?= $membre['nom'] ?></div>
                        <?php endforeach; ?>
                </section>
                        <?php endif;?>
            </main>
            <footer>
                <p>Réalisé par Jason en Anthestérion de l'an 515 avant JC</p>
            </footer>
        </div>
    </body>
</html>