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
    
    




</div>

<div class="bg-light text-center mt-3 p-4">
    <div class="mx-auto d-inline-block text-left mb-3">
        <h2>Categories:</h2>
        <?php echo $categoriesList ?>
    </div>
</div>
