<div class="container text-center">


<?php if($this->session->flashdata('not_loggedin') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <strong>Error!</strong> No tens permís d'accedir sense iniciar sessió abans.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


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