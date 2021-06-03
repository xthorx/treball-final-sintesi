<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('administracio_categories/editar')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="categoriaid" class="form-control text-center" value="<?php echo $editarCategoria[0]->id; ?>" hidden><br>

    <input type="text" class="form-control text-center" value="<?php echo $editarCategoria[0]->id; ?>" disabled><br>
    
    
    
    <input type="text" name="categorianame"  class="form-control text-center" value="<?php echo $editarCategoria[0]->nom; ?>" required><br>
    


    <label for="categoriapare">Escull la categoria pare:</label>
    <select name="categoriapare" class="form-control">
        <option value='0'>-Sense categoria pare-</option>

        <?php

            foreach ($categoriesList as $rec){

                if($editarCategoria[0]->categoria_pare == $rec->id){
                    echo "<option value='".$rec->id."' selected>".$rec->nom."</option>";
                }else{
                    echo "<option value='".$rec->id."'>".$rec->nom."</option>";
                }

            }

        ?>
    </select><br>


    

    <input type="submit" name="submit" value="Guardar canvis" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>