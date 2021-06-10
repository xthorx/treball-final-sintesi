<!doctype html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title><?php echo $title; ?></title>
      <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css")?>">
      <link rel="stylesheet" href="<?php echo base_url("assets/css/estils.css")?>">
      <link href="<?php echo base_url("assets/fontawesome/css/all.css")?>" rel="stylesheet">



      <script src="<?php echo base_url("assets/js/ckeditor.js")?>"></script>
      <script src="<?php echo base_url("assets/js/jquery.min.js")?>"></script>
      <script src="<?php echo base_url("assets/js/popper.js")?>"></script>
      <script src="<?php echo base_url("assets/js/bootstrap.min.js")?>"></script>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Menu</span>
	        </button>
        </div>
				<div class="p-4">
		  		<h1><a href="<?php echo base_url()?>" class="logo">DWTube <span>Recursos educatius</span></a></h1>
	        <ul class="list-unstyled components mb-5">


	          <li class="active">
	            <a href="<?php echo base_url()?>"><span class="fa fa-home mr-3"></span> Pàgina d'inici</a>
	          </li>

             <li class="active">
	            <a href="<?php echo base_url("recursos_mostrar")?>"><span class="fa fa-book mr-3"></span> Mostrar recursos</a>
	          </li>

             <li class="active">
	            <a href="<?php echo base_url("buscador")?>"><span class="fa fa-search mr-3"></span> Buscador</a>
	          </li>

            <?php if($grup_usuari=="admin"){ ?>
	          <li>
               <a class="btn btn-link px-0 text-left collapsed collapseMenuButton" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                  <span class="fa fa-chevron-up mr-3"></span> Opcions d'administrador
               </a>
               <div id="collapse1" class="collapse" aria-labelledby="headingTwo">
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("admin/usuaris")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar usuaris
                  </a>
               </div>
             </li>
             <?php } if($grup_usuari=="professor" || $grup_usuari=="admin"){ ?>

               <li>
             
               <a class="btn btn-link px-0 text-left collapsed collapseMenuButton" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                  <span class="fa fa-chevron-up mr-3"></span> Opcions de professor
               </a>
               <div id="collapse2" class="collapse" aria-labelledby="headingTwo">
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("recursos")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar recursos
                  </a>
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("admin/alumnes")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar alumnes
                  </a>
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("administracio_tags")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar tags
                  </a>
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("administracio_categories")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar categories
                  </a>
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("administracio_classes")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar classes
                  </a>
               </div>
               </li>

               <?php } if($grup_usuari=="alumne" || $grup_usuari=="professor" || $grup_usuari=="admin"){ ?>

               <li>
               <a class="btn btn-link px-0 text-left collapsed collapseMenuButton" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                  <span class="fa fa-chevron-up mr-3"></span> Opcions d'usuari
               </a>
               <div id="collapse3" class="collapse" aria-labelledby="headingTwo">
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("recursos/preferits")?>">
                     <span class="fa fa-book mr-3 pl-4"></span> Recursos preferits
                  </a>
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("perfil")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Editar perfil
                  </a>
                  <a class="btn btn-link px-0 text-left" href="<?php echo base_url("contrasenya")?>">
                     <span class="fa fa-user mr-3 pl-4"></span> Canviar contrasenya
                  </a>
               </div>
               </li>


               <br><br>
               <?php echo "Benvingut, $usuariLogat_nom" ?>
               <a class="btn btn-outline-danger" href="<?php echo base_url("tancar_sessio")?>">Tancar la sessió</a>

               <?php } else if($grup_usuari=="no"){ ?>
                  <li>
                  <a class="btn btn-link px-0 text-left collapsed collapseMenuButton" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                     <span class="fa fa-chevron-up mr-3"></span> Opcions d'invitat
                  </a>
                  <div id="collapse3" class="collapse" aria-labelledby="headingTwo">
                     <a class="btn btn-link px-0 text-left" href="<?php echo base_url("login")?>">
                        <span class="fa fa-user mr-3 pl-4"></span> Iniciar sessió   
                     </a>
                     <a class="btn btn-link px-0 text-left" href="<?php echo base_url("register")?>">
                        <span class="fa fa-user mr-3 pl-4"></span> Registre
                     </a>
                  </div>
                  </li>
               <?php } ?>
	        </ul>

	        <div class="footer">
	            <p>Gràcies per visitar la nostra web.</p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">