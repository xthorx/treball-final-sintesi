<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('crear_recurs')?>" method="POST" class="mx-auto" style="max-width: 250px">

    <input type="text" name="titol" placeholder="Titol" class="form-control text-center" required><br>
    
    <textarea name="descripcio" id="editor"></textarea><br>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <label for="categoria">Tria una categoria:</label>
    <select name="categoria" class="form-control">

        <?php

            foreach ($categoriesList as $rec){
                echo "<option value='".$rec->id."'>".$rec->nom."</option>";
            }

        ?>
    </select><br>
    
    <input type="text" name="tipus_recurs" placeholder="Tipus de recurs" class="form-control text-center" required><br>
    <input type="text" name="privadesa" placeholder="Privadesa" class="form-control text-center" required><br>



    <input type="submit" name="submit" value="Crear recurs" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>