<div class="container text-center">


<h2><?php echo $title; ?></h2>

<span class="text-danger"><?php echo validation_errors(); ?></span>

    
    
<form action="<?php echo base_url('crear_recurs')?>" method="POST" class="mx-auto mt-4" enctype="multipart/form-data">

    <label for="titol">Títol del recurs:</label>
    <input type="text" name="titol" placeholder="Titol" style="max-width: 300px; margin: 0 auto;" class="form-control text-center" required><br>
    
    <label for="descripcio">Descripció del recurs:</label>
    <textarea name="descripcio" id="editor"></textarea><br>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>


    <style>
        .ck-editor__editable {
            min-height: 200px !important;
        }
    </style>



    <label for="categoria">Tria una categoria:</label>
    <select name="categoria" class="form-control" style="max-width: 300px; margin: 0 auto;">

        <?php

            foreach ($categoriesList as $rec){
                echo "<option value='".$rec->id."'>".$rec->nom."</option>";
            }

        ?>
    </select><br>

    <label for="tipus_recurs">Tipus de recurs:</label>
    <select name="tipus_recurs" class="form-control" onchange="tipus_recurs_canviat()" style="max-width: 300px; margin: 0 auto;" id="tipus_recurs_selector">
        <option value='infografia'>Infografia</option>
        <option value='video_arxiu'>Arxiu de vídeo</option>
        <option value='video_youtube'>Vídeo de YouTube</option>
        <option value='pissarra'>Pissarra digital</option>
    </select><br>

    <div id="contingut_variable"></div><br>

    <p class="mb-2">Tags del recurs:</p>
    <div class="overflow-auto bg-light" style="max-width: 300px; margin: 0 auto; max-height: 200px">

        <?php foreach($tagslist as $tag){ ?>

            <label><input type="checkbox" name="check_list[]" value="<?php echo $tag->id; ?>"> <?php echo $tag->tag; ?></label><br>

        <?php } ?>

    </div><br>


    <label for="privadesa">Privadesa del recurs:</label>
    <select name="privadesa" class="form-control" style="max-width: 300px; margin: 0 auto;" id="tipus_recurs_selector">
        <option value='public'>Public</option>
        <option value='privat'>Privat</option>
        <optgroup label="Classes d'alumnes">
            <?php foreach($classesList as $classe){
                echo "<option value='$classe->id'>$classe->nom</option>";
            } ?>
        </optgroup>
    </select><br>


    <input type="submit" name="submit" value="Crear recurs" style="max-width: 300px; margin: 0 auto;" class="btn btn-primary">
    

</form>

<script>


tipus_recurs_canviat();

function tipus_recurs_canviat(){

    if(document.getElementById("tipus_recurs_selector").value=="infografia"){
        document.getElementById("contingut_variable").innerHTML= "<label for='infografia'><u>TIPUS INFOGRAFIA</u><br>Selecciona una imatge pel recurs:</label><input type='file' name='infografia' class='form-control' style='max-width: 300px; margin: 0 auto;' required>";

    }else if(document.getElementById("tipus_recurs_selector").value=="video_arxiu"){
        document.getElementById("contingut_variable").innerHTML= "<label for='video_arxiu'><u>TIPUS ARXIU DE VÍDEO</u><br>Selecciona una vídeo pel recurs:</label><input type='file' name='video_arxiu' class='form-control' style='max-width: 300px; margin: 0 auto;' required>";


    }else if(document.getElementById("tipus_recurs_selector").value=="video_youtube"){
        document.getElementById("contingut_variable").innerHTML= "<label for='video_youtube'><u>TIPUS ARXIU DE VÍDEO</u><br>Selecciona una vídeo pel recurs:</label><input type='text' name='video_youtube' placeholder='ID del vídeo de YouTube' class='form-control' style='max-width: 300px; margin: 0 auto;' required>";

    }else if(document.getElementById("tipus_recurs_selector").value=="pissarra"){

        document.getElementById("contingut_variable").innerHTML= "<iframe id='framePissarra' class='w-100' style='height: 400px;' frameBorder='0' scrolling='no' src='<?php echo base_url("pissarra")?>' title='Pissarra Digital'>";
        document.getElementById("contingut_variable").innerHTML += "<span onclick='guardarVideoiFrame()'>Guardar</span>";

    }else{alert("Tipus de recurs no vàlid.");location.reload();}
}

function guardarVideoiFrame(){

    var imgBase64= document.getElementById('framePissarra').contentWindow.document.getElementById('imatgeCanvas').src;
    document.cookie = "imageBase64Pissarra=" + imgBase64;

    document.getElementById("contingut_variable").innerHTML = "<img src='"+ imgBase64 +"'><input type='text' name='pissarra' value='"+ imgBase64 +"' hidden>";

}




</script>






<?php if (isset($missatge)){echo $missatge;} ?>
<?php if (isset($messageion)){echo "<div class='text-danger'>$messageion</div>";} ?>


</div>