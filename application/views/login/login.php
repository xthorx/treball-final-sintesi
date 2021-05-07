<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('login')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="user" placeholder="Usuari" class="form-control text-center" required><br>
    
    
    <input type="password" name="pass" placeholder="Contrasenya" class="form-control text-center" required><br>
    
    

    <input type="submit" name="submit" value="Login" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>