<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('administracio_classes/crear/')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="classename" placeholder="Nom de la classe" class="form-control text-center" required><br>
    
    

    <input type="submit" name="submit" value="Crear classe" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>