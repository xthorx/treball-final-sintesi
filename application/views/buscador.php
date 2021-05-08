<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('administracio_tags/crear/')?>" method="POST" class="mx-auto" style="max-width: 250px">
    <div class="row">
        <input type="text" name="tagname" placeholder="Text per buscar" class="form-control text-center d-inline-block col-9" required>
        <input type="submit" name="submit" value="Buscar" class="btn btn-primary d-inline-block col-3">
    </div>

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>