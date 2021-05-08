
<!-- <h1 class="text-center mb-5"><u><?php echo $titleMain;?></u></h1> -->

<div class="container p-0 mb-2">
    <a href="<?php echo base_url('crear_recurs')?>" class="btn btn-primary">Crear recurs</a>
</div>

<!-- <?php if($this->session->flashdata('errorformulari') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <strong>Vigila!</strong> Hi ha hagut un error en el teu formulari.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?> -->


<?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-light p-3 mb-2 container">

        <div class="row text-center">

            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $recurs->id?></p></div>
            <div class="col-5"><p class="m-0 p-0">Titol: <b><?php echo $recurs->titol?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Categoria: <b><?php echo $rec_categoria[$recurs->id]?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Autor: <b><?php echo $rec_autor[$recurs->id]?></b></p></div>

            <div class="col-2">
                <a href="<?php echo base_url("/recursos/editar/" . $recurs->id)?>" class="btn btn-primary">Editar</a>
                <a href="<?php echo base_url("/recursos/borrar/" . $recurs->id)?>" class="btn btn-danger">Borrar</a>
            </div>

        </div>

        

    </div>


    

<?php } ?>