<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/register.css');?>">
</head>
<body>
      <img class="background-image" src="<?php echo base_url('assets/img/background_connexion.png');?>"/> 
    <div class="wrapper">
        <h2>Login</h2>
        <p>Entrer vos informations pour vous connecter</p>
        <form action="<?php echo base_url('index.php/LoginController/index');?>" method="post">
            <div class="form-group <?php echo (!empty( $username_err )) ? 'has-error' : ''; ?>">
                <label>Pseudo</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
                <a href="<?php echo base_url('index.php/HomeController/index');?>" class="btn btn-not-connected"> Ne pas se connecter</a>
            </div>
            <p>Vous n'avez pas encore de compte? <a href="<?php echo base_url('index.php/RegisterController/index');?>">S'enregistrer maintenant</a>.</p>
        </form>
    </div>    
</body>
</html>