<div clasS="container">

    <a class="border bg-light p-3 rounded"><?php echo $inforecurs->categoria; ?></a>

    <h1 class="border bg-light p-3 rounded"><?php echo $inforecurs->titol; ?></h1>

    <div class="border bg-light p-3 rounded"><?php echo $inforecurs->descripcio; ?></div>


    <?php if($inforecurs->tipus_recurs=="infografia"){ ?>

        <img src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" alt="Infografia">

    <?php }else if($inforecurs->tipus_recurs=="video_arxiu"){ ?>

        <video src="<?php echo base_url("uploads/recurs_" . $inforecurs->id . "/" . $inforecurs->arxiu_name) ?>" class="img-fluid mt-2" controls></video>

    <?php } ?>


</div>