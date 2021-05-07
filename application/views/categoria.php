<h1 class="text-center mb-5"><u><?php echo $titleMain;?></u></h1>


<?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-primary p-3 mb-2">

        <h2><?php echo $recurs->titol?></h2>
        <p class="m-0">Categoria: <?php echo $rec_categoria?></p>
        <p class="m-0">Autor del recurs: <?php echo $rec_autor?></p>

    </div>


    

<?php } ?>