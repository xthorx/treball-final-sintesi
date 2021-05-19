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
    
    <div class="mb-3">
        <a href="perfil" class="btn btn-secondary">Editar perfil</a>
        <a href="recursos" class="btn btn-primary">Veure recursos</a>
        <a href="crear_recurs" class="btn btn-warning">Crear recurs</a>
    </div>
    
    <div class="mb-3">
        <a href="administracio_tags" class="btn btn-success">CRUD Tags</a>
        <a href="administracio_categories" class="btn btn-success">CRUD Categories</a>
        <a href="administracio_classes" class="btn btn-success">CRUD Classes</a>
    </div>

    <!-- <div class="mb-3">
        <a href="grocerycrud_news/news_management/" class="btn btn-primary">Grocery Crud Editor (Nomes usuaris)</a>
    </div> -->

</div>

<div class="bg-light text-center mt-3 p-4">
    <div class="mx-auto d-inline-block text-left mb-3">
        <h2>Categories:</h2>
        <?php echo $categoriesList ?>
    </div>
</div>
