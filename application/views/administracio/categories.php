<!-- <h1 class="text-center mb-5"><u><?php echo $titleMain;?></u></h1> -->

<div class="container p-0 mb-2">
    <a href="<?php echo base_url('administracio_categories/crear/')?>" class="btn btn-primary">Crear categoria</a>
</div>

<?php foreach($categoriaList as $cat){ ?>
    <div class="bg-light p-3 mb-2 container">

        <div class="row text-center">

            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $cat->id?></p></div>
            <div class="col-4"><p class="m-0 p-0">Nom de la categoria: <b><?php echo $cat->nom?></b></p></div>
            <div class="col-3"><p class="m-0 p-0">Categoria pare: <b><?php echo $cat->categoria_pare?></b></p></div>
            <div class="col-4">
                <a href="<?php echo base_url("/administracio_categories/editar/".$cat->id)?>" class="btn btn-primary">Editar</a>
                <a href="<?php echo base_url("/administracio_categories/borrar/".$cat->id)?>" class="btn btn-danger">Borrar</a>
            </div>

        </div>

        

    </div>


    

<?php } ?>