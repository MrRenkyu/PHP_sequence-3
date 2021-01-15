<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mon profil</title>
    <link rel="stylesheet" href="../assets/css/profil.css">
</head>

<body>
    <div class="container">

        <div class="item Entete">

			<a href="index.php?action=home"><img class="homeImg" src="../assets/img/home.png"/></a>
            <h1> Mon profil </h1>
        </div>

        <div class="item G1">

        </div>

        <div class="item G2">

        </div>
        <div class="item A1">

            
            <label for="label-id">Ton id est le : <?php echo($profilId); ?> </label>
            
            <form action="<?php echo base_url('index.php/ProfilController/updateData');?>" method="post">

                <label for="name">Nom : </label><br>
                <textarea name="profilNom" id="nom" maxlength="50" required><?php echo($profilNom);  ?></textarea><br>

                <label for="name">Prénom : </label><br>
                <textarea name="profilPrenom" id="prenom" maxlength="50" required><?php echo($profilPrenom);  ?></textarea><br>

                <label for="name">Date de naissance : </label><br>
                <input type="date" id="date" name="profilDate" value="2001-07-22" min="1900-01-01" max=<?php date_default_timezone_set('UTC');
                echo date("Y-m-d")?>/>
                <br>

                <label for="name">Mot de passe : </label><br>
                <textarea name="profilPswd" id="mdp" maxlength="50"></textarea><br>
                <span class="help-block"><?php echo $password_err; ?></span>


                <button class="saveBT"type="submit" name="insert" value="insert">Sauvegarder</button>
            </form>

        </div>

        <div class="item Footer">Fait part Thibault Derouin, Romain Molle et Enzo Levillain</div>

    </div>
</body>
