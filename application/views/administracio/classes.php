<h1 class="text-center"><?php echo $title; ?></h1>

<div class="container p-0 mb-2">
    <a href="<?php echo base_url('administracio_classes/crear/')?>" class="btn btn-primary">Crear classe</a>
</div>

<?php foreach($classeList as $classe){ ?>
    <div class="bg-light p-3 mb-2 container">

        <div class="row text-center">

            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $classe->id?></p></div>
            <div class="col-7"><p class="m-0 p-0">Nom de la classe: <b><?php echo $classe->nom?></b></p></div>
            <div class="col-4">
                <a href="<?php echo base_url("/administracio_classes/editar/".$classe->id)?>" class="btn btn-primary">Editar</a>
                <a href="<?php echo base_url("/administracio_classes/borrar/".$classe->id)?>" class="btn btn-danger">Borrar</a>
            </div>

        </div>

        

    </div>


    

<?php } ?>