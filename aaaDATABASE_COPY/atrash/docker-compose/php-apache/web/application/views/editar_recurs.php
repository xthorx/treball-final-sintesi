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
    <div class="overflow-auto bg-light" style="max-width: 300px; margin: 0 auto; max-height: 500px">

        <?php foreach($totsTags as $tag){ 
            
            $trobat= 0;
            foreach($tagsUsuari as $tagus){
                if($tag->id== $tagus->id){ ?>
                    <label><input type="checkbox" name="check_list[]" value="<?php echo $tag->id; ?>"checked> <?php echo $tag->tag; ?></label><br>
                <?php $trobat++; }
            }

            if($trobat==0){ ?>
                <label><input type="checkbox" name="check_list[]" value="<?php echo $tag->id; ?>"> <?php echo $tag->tag; ?></label><br>
            <?php } ?>
            
        <?php } ?>

    </div><br>


    <label for="privadesa">Privadesa del recurs:</label>
    <select name="privadesa" class="form-control" onchange="tipus_recurs_canviat()" style="max-width: 300px; margin: 0 auto;" id="tipus_recurs_selector">
        
        <?php if($recursInfo[0]->privadesa == "public"){
            echo "<option value='public' selected>Public</option>";
            echo "<option value='privat'>Privat</option>";
        }else if($recursInfo[0]->privadesa == "privat"){
            echo "<option value='public'>Public</option>";
            echo "<option value='privat' selected>Privat</option>";
        }else{
            echo "<option value='public'>Public</option>";
            echo "<option value='privat'>Privat</option>";
        }?>

        <optgroup label="Classes d'alumnes">
            <?php foreach($classesList as $classe){

                if($classe->id == $recursInfo[0]->privadesa){
                    echo "<option value='$classe->id' selected>$classe->nom</option>";
                }else{
                    echo "<option value='$classe->id'>$classe->nom</option>";
                }
                
            } ?>
        </optgroup>
    </select><br>


    <input type="submit" name="submit" value="Guardar canvis" class="btn btn-primary">
    

</form>

<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>