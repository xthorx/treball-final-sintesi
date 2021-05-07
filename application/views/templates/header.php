<html>
<head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/estils.css")?>">

        <script src="<?php echo base_url("assets/js/jquery-3.5.1.min.js")?>"></script>
        <script src="<?php echo base_url("assets/js/bootstrap.min.js")?>"></script>
        <script src="<?php echo base_url("assets/js/ckeditor.js")?>"></script>
</head>
<body>

<?php

  if(isset($this->session->user)){
    $loggedHeader=true;
  }

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">

  <a class="navbar-brand" href="<?php echo base_url()?>">DWTube</a>

  <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navb" style="">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Link 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Link 2</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php if($loggedin==false){ ?>
          <a class="nav-link" href="<?php echo base_url("login")?>">Iniciar sessió</a>
        <?php }else{ ?>
          <a class="nav-link disabled">Benvingut, <?php echo $usuariLogat_nom?></a>
        <?php } ?>

      </li>
      <li class="nav-item">
        <?php if($loggedin==false){ ?>
          <a class="nav-link" href="<?php echo base_url("register")?>">Registre</a>
        <?php }else{ ?>
          <a class="nav-link" href="<?php echo base_url("tancar_sessio")?>">Tancar la sessió</a>
        <?php } ?>
      
      </li>
    </ul>
  </div>
</nav>

                

<!-- final del header.php -->