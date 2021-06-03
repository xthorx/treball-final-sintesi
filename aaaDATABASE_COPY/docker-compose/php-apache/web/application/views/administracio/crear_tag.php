<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('administracio_tags/crear/')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="tagname" placeholder="Nom del tag" class="form-control text-center" required><br>
    
    

    <input type="submit" name="submit" value="Crear tag" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>