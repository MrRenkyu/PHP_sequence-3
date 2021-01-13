<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrateur</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Admin.css');?>" >
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script>
        function getArticle(idArticle){
            jQuery.ajax({
              url: "model/admin_manager.php",
              type: "POST",
              data: ({id: idArticle, action: "getArticle"}),
            success: function(data){
                document.location.reload();
            }
            });
        }

        function doAction(actionToDo){
            var textTitle = document.getElementById('textTitle');
            var textSummary = document.getElementById('textSummary');
            var textContent = document.getElementById('textContent');
            var textAuthor = document.getElementById('textAuthor');
            var textDate = document.getElementById('textDate');
            var checkboxPublic =  document.getElementById('checkboxPublic');
            var pub = 0;
            if (checkboxPublic.checked){
               pub = 1;
            }
            jQuery.ajax({
              url: "model/admin_manager.php",
              type: "POST",
              data: ({action: actionToDo, title: textTitle.value,
              summary: textSummary.value, content: textContent.value,
              author: textAuthor.value,
              date: textDate.value, public: pub}),
            success: function(data){
                document.location.reload();
            }
            });
        }
    </script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</head>
<body>
    <div class="container">

      <div class="item Entete">
        <h1> Administrateur </h1>
      </div>

      <div class="item Gauche">
        <p>
            <a <?php echo 'href="index.php?action=home"' ?>>Retour à la page d'accueil</a>
        </p>
      </div>
      <div class="item GaucheBas">
          <?php 
               $articles_proposal;
           ?>
      </div>

      <div class="item A1">
          <label for="name">Titre de l'article : </label><br>

          <textarea id="textTitle" name="mTitle" class="textArea" maxlength="3000" required><?php ShowTitle();?></textarea><br>

          <label for="name">Résumé : </label><br>

          <textarea id="textSummary" name="mResume" class="resume" maxlength="3000" required><?php ShowSummary();?></textarea><br>

          <label for="name">Article : </label><br>

          <textarea id="textContent" name="mContent" class="article" maxlength="3000" required><?php ShowContent();?></textarea><br>

          <label for="name">Auteur : </label><br>

          <textarea id="textAuthor" name="mAuthor" class="textArea" maxlength="3000" required><?php ShowAuthor();?></textarea><br>

          <label for="name">Date de publication : </label><br>

          <textarea id="textDate" name="mDate" class="textArea" maxlength="3000" required><?php ShowPublicationDate();?></textarea><br>

          <input type="checkbox" id="checkboxPublic" name="checkboxPublic" <?php IsPublic(); ?>></input>
          <label for="checkboxPublic">Publique </label>

          <button type="submit" name="insert" value="insert" onclick="doAction('addArticle')">Ajouter</button>
          <button type="submit" name="insert" value="insert" onclick="doAction('updateArticle')">Modifier</button>
          <button type="submit" name="insert" value="insert" onclick="doAction('deleteArticle')">Supprimer</button>
      </div>

      <div class="item Footer">Fait par Thibault Derouin, Romain Molle, Enzo Levillain</div>

      </div>
</body>
</html>
