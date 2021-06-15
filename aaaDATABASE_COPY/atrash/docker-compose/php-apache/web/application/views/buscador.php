<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
<?php if(!$this->input->get('buscador_avancat')){ ?>
    <form action="<?php echo base_url('buscador')?>" method="POST" class="mx-auto" style="max-width: 250px">
        <p class="m-0">Buscador per titol i descripcio</p>
        <div class="row">
            <input type="text" name="busqueda" placeholder="Text per buscar" class="form-control text-center d-inline-block col-10" required>
            

            <button type="submit" class="btn btn-primary col-2 mb-3">
                <i class="fas fa-search"></i>
            </button>

        </div>
        <a href="?buscador_avancat=true">Buscador avançat</a>
    </form>
<?php }else{ ?>

    <form action="<?php echo base_url('buscador?buscador_avancat=true')?>" method="POST" class="mx-auto" style="max-width: 250px">
        <p class="m-0">Buscador per titol i descripcio</p>

        <input type="text" name="busqueda" placeholder="Text per buscar" class="form-control text-center d-inline-block" required>

        <p class="m-0 mt-2">Buscador per tags</p>


        <select name="tagFiltre" class="form-control">
            <?php

                foreach ($totsTags as $tag){
                    echo "<option value='".$tag->id."' selected>".$tag->tag."</option>";
                }

            ?>
        </select>


        <button type="submit" class="btn btn-primary my-3">
            <i class="fas fa-search"></i> Buscar
        </button>

        <a href="<?php echo base_url('buscador')?>">Buscador senzill</a>
    </form>

<?php } ?>



<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>




<?php if(!$this->input->get('buscador_avancat')){if(isset($tagsFiltre)){ ?>
    <div class="container text-right mb-2">
        <h3>Filtrar per tags:</h3>


        <form action="<?php echo base_url('buscador')?>" method="POST">

            <input type="text" name="busqueda" value="<?php echo $busqueda_text; ?>" hidden>

            <select name="tagFiltre" class="form-control d-inline-block w-auto mr-1">
                    <?php

                        foreach ($totsTags as $tag){
                            echo "<option value='".$tag->id."' selected>".$tag->tag."</option>";
                        }

                    ?>
            </select>

            <button type="submit" class="btn btn-primary w-auto float-right">
                <i class="fas fa-search"></i> Filtrar
            </button>
        </form>

        <form action="<?php echo base_url('buscador')?>" method="POST">

            <input type="text" name="busqueda" value="<?php echo $busqueda_text; ?>" hidden>

            <button type="submit" class="btn btn-outline-primary">
                Resetejar filtre
            </button>
        </form>


        

    </div>
<?php }} ?>



<?php if(isset($resultatBusqueda)){

    if(isset($no_resultat)){
        echo "<div class='bg-light p-3 mb-2 container text-center'>No s'ha trobat cap resultat a la teva busqueda.</div>";
    }
    foreach($resultatBusqueda as $recurs){ ?>

    <div class="bg-light p-3 mb-2 container border">
        <div class="row text-center">
            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $recurs->id?></p></div>
            <div class="col-3"><p class="m-0 p-0">Titol: <a href="recursos/mostrar/<?php echo $recurs->id?>"><b><?php echo $recurs->titol?></b></a></p></div>
            <div class="col-2"><p class="m-0 p-0">Categoria: <b><?php echo $rec_categoria[$recurs->id]?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Autor: <b><?php echo $rec_autor[$recurs->id]?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Tipus: <b><?php echo $recurs->tipus_recurs?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Tag/s: <b><?php echo implode(', ',$tags_recurs_list[$recurs->id]) ?></b></p></div>
        </div>
    </div>
<?php }} ?>



<?php if(isset($resultatBusquedaTags)){

if(isset($no_resultat)){
    echo "<div class='bg-light p-3 mb-2 container text-center'>No s'ha trobat cap resultat a la teva busqueda.</div>";
}
foreach($resultatBusquedaTags as $recurs){ ?>
<div class="bg-light p-3 mb-2 container border">
        <div class="row text-center">
            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $recurs->id?></p></div>
            <div class="col-3"><p class="m-0 p-0">Titol: <a href="recursos/mostrar/<?php echo $recurs->id?>"><b><?php echo $recurs->titol?></b></a></p></div>
            <div class="col-2"><p class="m-0 p-0">Categoria: <b><?php echo $rec_categoria[$recurs->id]?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Autor: <b><?php echo $rec_autor[$recurs->id]?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Tipus: <b><?php echo $recurs->tipus_recurs?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Tag/s: <b><?php echo $recurs->tag ?></b></p></div>
        </div>
</div>
<?php }} ?>

</div>