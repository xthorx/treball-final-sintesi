<!-- <h1 class="text-center mb-5"><u><?php echo $titleMain;?></u></h1> -->

<div class="container p-0 mb-2">
    <a href="<?php echo base_url('administracio_tags/crear/')?>" class="btn btn-primary">Crear tag</a>
</div>

<?php foreach($tagsList as $tag){ ?>
    <div class="bg-light p-3 mb-2 container">

        <div class="row text-center">

            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $tag->id?></p></div>
            <div class="col-7"><p class="m-0 p-0">Nom del tag: <b><?php echo $tag->tag?></b></p></div>
            <div class="col-4">
                <a href="<?php echo base_url("/administracio_tags/editar/".$tag->id)?>" class="btn btn-primary">Editar</a>
                <a href="<?php echo base_url("/administracio_tags/borrar/".$tag->id)?>" class="btn btn-danger">Borrar</a>
            </div>

        </div>

        

    </div>


    

<?php } ?>