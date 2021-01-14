<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Style.css');?>">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script>
       function SelectArticle(idArticle){
         /*
            jQuery.ajax({
              url: "<?php echo base_url('index.php/ReaderController/index');?>",
              type: "POST",
              data: ({id: idArticle}),
            success: function(data){
             // window.location.href='index.php/ReaderController/index';
            }
            });
            */
            window.location.href='<?php echo base_url('index.php/ReaderController/index/');?>'+idArticle;
        }
    </script>
</head>
<body>    
    <div class="container">

      <div class="item Entete">
        <h1>Acceuil</h1>
        <p>
        <?php  
          echo $stringButton;
        ?>        
    </p>
      </div>

      <div class="item Gauche">
          <?php
            echo $stringMenu;
           ?>
      </div>

      <div class="item A1">
          <?php 
            echo $stringArticle1;
          ?>
      </div>

      <div class="item A2">
          <?php 
            echo $stringArticle2;
          ?>
      </div>

      <div class="item A3">
          <?php 
            echo $stringArticle3;
          ?>       
      </div>

      <div class="item Footer">
          Fait par Thibault Derouin, Romain Molle, Enzo Levillain
      </div>

      </div>

  </div>
</body>
</html>