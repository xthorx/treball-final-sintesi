<div clasS="container">

    <p class="border p-3 d-inline-block">Categoria: <a href="<?php echo base_url("categoria/" . $inforecurs->categoria); ?>"><?php echo $categoriarecurs; ?></a></p>

    <h1 class="border bg-light p-3 rounded"><?php echo $inforecurs->titol; ?></h1>

    <div class="border bg-light p-3 rounded"><?php echo $inforecurs->descripcio; ?></div>


    <?php if($inforecurs->tipus_recurs=="infografia"){ ?>

        <img src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" alt="Infografia">

    <?php }else if($inforecurs->tipus_recurs=="video_arxiu"){ ?>

        <video src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" controls></video>

    <?php } ?>


    
    <div class="border bg-light p-3 rounded mt-3">
        <p class="m-0 p-0 d-inline-block">Tags:</p>
        
        <?php foreach($tagsrecurs as $tag){ ?>

            <p class="m-2 p-2 d-inline-block border rounded"><?php echo $tag->tag; ?></p>

        <?php } ?>

    </div>


</div>