<?php if($this->input->get('session')=="logged"){ ?>

<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    Benvingut a la web, <strong><?php echo $this->session->user ?></strong>! Ja tens la sessió iniciada.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
</div>

<?php } ?>

<div class="container text-center">
    <h2><?php echo $title; ?></h2>
    <p><?php echo $subtitle; ?></p>
    
    <div class="mb-3">
        <a href="recursos" class="btn btn-primary">Veure recursos</a>
        <a href="crear_recurs" class="btn btn-warning">Crear recurs</a>
    </div>
    
    <div class="mb-3">
        <a href="administracio_tags" class="btn btn-success">CRUD Tags</a>
        <a href="administracio_categories" class="btn btn-success">CRUD Categories</a>
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
