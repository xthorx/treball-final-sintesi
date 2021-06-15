<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('administracio_classes/editar')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="classeid" class="form-control text-center" value="<?php echo $editarClasse[0]->id; ?>" hidden><br>

    <input type="text" class="form-control text-center" value="<?php echo $editarClasse[0]->id; ?>" disabled><br>
    
    
    
    <input type="text" name="classename"  class="form-control text-center" value="<?php echo $editarClasse[0]->nom; ?>" required><br>
    
    

    <input type="submit" name="submit" value="Guardar canvis" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>