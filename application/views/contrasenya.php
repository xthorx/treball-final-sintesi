<div class="container text-center">


<?php if($this->session->flashdata('message') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <?php echo $this->session->flashdata('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

<form action="<?php echo base_url('contrasenya')?>" method="POST" class="mx-auto text-center mt-4" style="max-width: 250px">

    <input type="text" name="contra_vella" style="max-width: 250px;" placeholder="Contrasenya vella" class="form-control text-center mb-4 " required>
    
    <input type="text" name="contra_nova1" style="max-width: 250px;" placeholder="Contrasenya nova" class="form-control text-center mb-2 " required>
    <input type="text" name="contra_nova2" style="max-width: 250px;" placeholder="Repeteix la nova contrasenya" class="form-control text-center " required>

        
    <input type="submit" name="submit" value="Guardar canvis" class="btn btn-primary mt-4">     

</form>

<?php if (isset($missatge)){echo $missatge;} ?>


</div>