<div class="container text-center">
    <h1>Edició de l'alumne <?php echo $infoUsuari[0]->username ?></h1>

    <form action="" method="POST">

        <div class="overflow-auto bg-light p-4 w-25 mx-auto">
        <p class="mb-4">Classes de l'alumne:<br>Vols afegir-ne? <a href="<?php echo base_url("administracio_classes") ?>">Admin classes</a></p>

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

        <button class="btn btn-primary" type="submit">Guardar Canvis</button>
    </form>

    <a href="<?php echo base_url("admin/alumnes") ?>"><i class="fas fa-arrow-circle-left"></i> Tornar a l'administrador d'alumnes</a>
</div>