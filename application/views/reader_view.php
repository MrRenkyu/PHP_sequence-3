<!DOCTYPE html>
<html lang="fr">
    <head>
          <meta charset="utf-8">
          <title>Projet php</title>
          <link rel="stylesheet" href="<?php echo base_url('assets/css/StyleReader.css');?>">
    </head>
<body>

	<div class="container">

      <div class="item Entete">
          <p>PHP<p>
      </div>

      <div class="item GaucheHaut">
           <?php echo $details;?>
      </div>

      <div class="item GaucheBas">
          <p>Test GB<p>
      </div>

      <div class="item Mid">
      <?php echo $content;?>
      </div>

      <div class="item Footer">Fait</div>

      </div>

  </div>

</body>
