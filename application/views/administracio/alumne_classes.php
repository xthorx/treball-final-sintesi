
<div class="overflow-auto bg-light p-4 w-25 mx-auto">
<p class="mb-4">Tags del recurs:</p>

    <?php foreach($totesClasses as $classe){ 
        
        $trobat= 0;
        foreach($classesAlumne as $classealumne){
            if($classe->id== $classealumne->id){ ?>
                <label><input type="checkbox" name="check_list[]" value="<?php echo $classe->id; ?>"checked> <?php echo $classe->nom; ?></label><br>
            <?php $trobat++; }
        }

        if($trobat==0){ ?>
            <label><input type="checkbox" name="check_list[]" value="<?php echo $classe->id; ?>"> <?php echo $classe->nom; ?></label><br>
        <?php } ?>

        

        

    <?php } ?>

</div><br>