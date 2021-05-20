<?php if($this->session->flashdata('message') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <?php echo $this->session->flashdata('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<div class="container text-center">
    <h2><?php echo $title; ?></h2>
    <p><?php echo $subtitle; ?></p>
    

    <?php if($grup_usuari=="admin"){ ?>


        <div class="mb-3">
            <a href="admin/usuaris" class="btn btn-danger">Administracio usuaris</a>
        </div>

        <div class="mb-3">
            <a href="recursos" class="btn btn-primary">Administracio recursos</a>
            <a href="administracio_tags" class="btn btn-primary">Administracio tags</a>
        </div>
        <div class="mb-3">
            <a href="administracio_categories" class="btn btn-primary">Administracio categories</a>
            <a href="administracio_classes" class="btn btn-primary">Administracio classes</a>
        </div>

        <div class="mb-3">
            <a href="admin/alumnes" class="btn btn-primary">Administracio alumnes</a>
        </div>

        <div class="mb-3">
            <a href="perfil" class="btn btn-secondary">Perfil</a>
            <a href="contrasenya" class="btn btn-dark">Canviar contrasenya</a>
        </div>
        
    <?php }else if($grup_usuari=="professor"){ ?>

        <div class="mb-3">
            <a href="recursos" class="btn btn-primary">Administracio recursos</a>
            <a href="administracio_tags" class="btn btn-primary">Administracio tags</a>
        </div>
        <div class="mb-3">
            <a href="administracio_categories" class="btn btn-primary">Administracio categories</a>
            <a href="administracio_classes" class="btn btn-primary">Administracio classes</a>
        </div>

        <div class="mb-3">
            <a href="admin/alumnes" class="btn btn-primary">Administracio alumnes</a>
        </div>

        <div class="mb-3">
            <a href="perfil" class="btn btn-secondary">Perfil</a>
            <a href="contrasenya" class="btn btn-dark">Canviar contrasenya</a>
        </div>

    <?php }else if($grup_usuari=="alumne"){ ?>
        <div class="mb-3">
            <a href="perfil" class="btn btn-primary">Perfil</a>
            <a href="contrasenya" class="btn btn-dark">Canviar contrasenya</a>
        </div>
    <?php }else{ ?>
        <div class="mb-3">
            <a href="login" class="btn btn-primary">Iniciar sessió</a>
            <a href="register" class="btn btn-dark">Registre</a>
        </div>
    <?php } ?>




</div>

<div class="bg-light text-center mt-3 p-4">
    <div class="mx-auto d-inline-block text-left mb-3">
        <h2>Categories:</h2>
        <?php echo $categoriesList ?>
    </div>
</div>
