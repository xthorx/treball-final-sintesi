<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('recursos/editar')?>" method="POST" class="mx-auto mt-4">

    <input type="text" name="id" value="<?php echo $recursInfo[0]->id ?>" hidden><br>
    
    <label for="titol">Títol del recurs:</label>
    <input type="text" name="titol" placeholder="Titol" class="form-control text-center" style="max-width: 300px; margin: 0 auto;" value="<?php echo $recursInfo[0]->titol ?>" required><br>
    
    <label for="descripcio">Descripció del recurs:</label>
    <textarea name="descripcio" id="editor"></textarea><br>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                editor.setData("<?php echo htmlspecialchars_decode($recursInfo[0]->descripcio); ?>")
                
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <label for="categoria">Tria una categoria:</label>
    <select name="categoria" class="form-control" style="max-width: 300px; margin: 0 auto;">

        <?php

            foreach ($categoriesList as $rec){
                echo "<option value='".$rec->id."'>".$rec->nom."</option>";
            }

        ?>
    </select><br>

    <style>

        .ck-editor__editable {
            min-height: 200px !important;
        }
    
    </style>
    
    <label for="tipus_recurs">Tipus de recurs:</label>
    <input type="text" name="tipus_recurs" class="form-control text-center" style="max-width: 300px; margin: 0 auto;" value="<?php echo $recursInfo[0]->tipus_recurs ?>" disabled><br>

    <div id="contingut_variable"></div><br>

    <p class="mb-2">Tags del recurs:</p>
    <div class="overflow-auto bg-light" style="max-width: 300px; margin: 0 auto; max-height: 100px">

        <?php foreach($tagslist as $tag){ ?>

            <label><input type="checkbox" name="check_list[]" value="<?php echo $tag->id; ?>"><?php echo $tag->tag; ?></label><br>

        <?php } ?>

    </div><br>

    <label for="tipus_recurs">Privadesa del recurs:</label>
    <input type="text" name="privadesa" placeholder="Privadesa" class="form-control text-center" style="max-width: 300px; margin: 0 auto;" value="<?php echo $recursInfo[0]->privadesa ?>" required><br>



    <input type="submit" name="submit" value="Crear recurs" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>