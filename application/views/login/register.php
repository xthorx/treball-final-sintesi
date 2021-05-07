<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

<form action="<?php echo base_url('register')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="user" placeholder="Usuari" class="form-control text-center" required><br>
    
    
    <input type="text" name="pass" placeholder="Contrasenya" class="form-control text-center" required><br>


    <input type="email" name="email" placeholder="Correu electrònic" class="form-control text-center" required><br>
    

    <input type="submit" name="submit" value="Register" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php //if (isset($login_info['username'])){echo $login_info['username'];} ?>
<?php //if (isset($login_info['password'])){echo $login_info['password'];} ?>


</div>