<div class="container text-center">


<?php if($this->session->flashdata('errorformulari') != NULL){ 
        if($this->session->flashdata('errorformulari') == "contrasenyes_no_iguals"){?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <strong>Vigila!</strong> No has escrit la contrasenya igual en els dos camps del formulari.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php }} ?>


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

<form action="<?php echo base_url('register')?>" method="POST" class="mx-auto text-center" style="max-width: 250px">

    <div class="border border-primary rounded text-center py-2 mb-3" style="width: 300px; margin-left: -25px">
        <input type="text" name="nom" style="max-width: 250px;" placeholder="Nom" class="form-control text-center mb-2 mx-auto" value='<?php echo $infoPerfil->first_name?>' required>
        <input type="text" name="cognoms" style="max-width: 250px" placeholder="Cognoms" class="form-control text-center mb-3 mx-auto" value='<?php echo $infoPerfil->last_name?>' required> 
        <input type="text" name="telf" style="max-width: 250px" placeholder="Telèfon" class="form-control text-center mx-auto" value='<?php echo $infoPerfil->phone?>' required>
    </div>

    <div class="border border-dark rounded text-center py-2 mb-3" style="width: 300px; margin-left: -25px">
        <input type="text" name="user" style="max-width: 250px;" placeholder="Usuari" class="form-control text-center mb-2 mx-auto" value='<?php echo $infoPerfil->username?>' required>

        <input type="email" name="email" style="max-width: 250px;" placeholder="Correu electrònic" class="form-control text-center mx-auto" value='<?php echo $infoPerfil->email?>' required>

        
    </div>
    
    



    <input type="submit" name="submit" value="Guardar canvis" class="btn btn-primary">

    <div class="my-3">
        <p class="mb-1 p-0">Vols canviar la contrasenya?</p>
        <a class="btn btn-secondary" href="<?php echo base_url('contrasenya')?>">Canviar contrasenya</a>
    </div>        

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php //if (isset($login_info['username'])){echo $login_info['username'];} ?>
<?php //if (isset($login_info['password'])){echo $login_info['password'];} ?>


</div>