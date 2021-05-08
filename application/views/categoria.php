<h1 class="text-center mb-5"><u><?php echo $titleMain;?></u></h1>





<?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-light p-3 mb-2 container">
        <div class="row text-center">
            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $recurs->id?></p></div>
            <div class="col-5"><p class="m-0 p-0">Titol: <b><?php echo $recurs->titol?></b></p></div>
            <div class="col-3"><p class="m-0 p-0">Categoria: <b><?php echo $rec_categoria?></b></p></div>
            <div class="col-3"><p class="m-0 p-0">Autor: <b><?php echo $rec_autor?></b></p></div>
        </div>
    </div>
<?php } ?>


<!-- <?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-primary p-3 mb-2">

        <h2><?php echo $recurs->titol?></h2>
        <p class="m-0">Categoria: <?php echo $rec_categoria?></p>
        <p class="m-0">Autor del recurs: <?php echo $rec_autor?></p>

    </div>


    

<?php } ?> -->