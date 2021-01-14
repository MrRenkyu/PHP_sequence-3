<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrateur</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Admin.css');?>">
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script>
         function add(){
            console.log("<?php echo base_url('index.php/AdminController/addArticle');?>");
            console.log("add method js");
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
              url: "<?php echo base_url('index.php/AdminController/addArticle');?>",
              type: "POST",
              data: ({title: textTitle.value,
              summary: textSummary.value, content: textContent.value,
              author: textAuthor.value,
              date: textDate.value, public: pub}),
            success: function(data){
               window.location.href = "<?php echo base_url('index.php/AdminController/index');?>"
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
            <a href="<?php echo base_url('index.php/HomeController/index');?>" >Retour à la page d'accueil</a>
        </p>
      </div>
      <div class="item GaucheBas">
          <?php 
               echo $articles_proposal;
           ?>
      </div>

      <div class="item A1">
          <label for="name">Titre de l'article : </label><br>

          <textarea id="textTitle" name="mTitle" class="textArea" maxlength="3000" required></textarea><br>

          <label for="name">Résumé : </label><br>

          <textarea id="textSummary" name="mResume" class="resume" maxlength="3000" required></textarea><br>

          <label for="name">Article : </label><br>

          <textarea id="textContent" name="mContent" class="article" maxlength="3000" required></textarea><br>

          <label for="name">Auteur : </label><br>

          <textarea id="textAuthor" name="mAuthor" class="textArea" maxlength="3000" required></textarea><br>

          <label for="name">Date de publication : </label><br>

          <textarea id="textDate" name="mDate" class="textArea" maxlength="3000" required></textarea><br>

          <input type="checkbox" id="checkboxPublic" name="checkboxPublic" ></input>
          <label for="checkboxPublic">Publique </label>

          <button type="submit" name="insert" value="insert" onclick="add()">Ajouter</button>
      </div>

      <div class="item Footer">Fait par Thibault Derouin, Romain Molle, Enzo Levillain</div>

      </div>
</body>
</html>
