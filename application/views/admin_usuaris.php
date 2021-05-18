<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery.dataTables.css")?>">
<script src="<?php echo base_url("assets/js/jquery.dataTables.js")?>"></script>




<h1 class="text-center"><?php echo $title; ?></h1>

<div class="container">
<form method='POST' action=''>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Usuari</th>
                <th>Correu</th>
                <th>Tipus usuari</th>
                <th>Actiu</th>
                <th>Nom</th>
                <th>Cognoms</th>
                <th>Tel·lèfon</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($infoUsers as $user){ ?>
                <tr>
                    <td id="user<?php echo $user->id ?>"><?php echo $user->username ?></td>
                    <td id="email<?php echo $user->id ?>"><?php echo $user->email ?></td>
                    <td id="desc<?php echo $user->id ?>"><?php echo $user->description ?><span id="groupHidden<?php echo $user->id ?>" hidden><?php echo $user->group_id ?></span></td>
                    <td id="act<?php echo $user->id ?>"><?php echo $user->active ?></td>
                    <td id="fname<?php echo $user->id ?>"><?php echo $user->first_name ?></td>
                    <td id="lname<?php echo $user->id ?>"><?php echo $user->last_name ?></td>
                    <td id="phone<?php echo $user->id ?>"><?php echo $user->phone ?></td>
                    <td>
                    <?php if($user->id != 1){ ?>
                        <span id="editarButton<?php echo $user->id ?>"><button class="btn btn-primary" type="button" id="editar<?php echo $user->id ?>" onclick="editarCasella(<?php echo $user->id ?>)"><i class="fas fa-edit"></i></button></span>
                        <a href="<?php echo base_url("borrar_usuari/" . $user->id) ?>" class="btn btn-danger" type="button" id="borrar<?php echo $user->id ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="<?php echo base_url("contrasenya_admin/" . $user->id) ?>" class="btn btn-secondary" id="borrar<?php echo $user->id ?>"><i class="fas fa-key"></i></a>
                    <?php }else{ ?>
                        <a href="<?php echo base_url("perfil") ?>" class="btn btn-primary" id="borrar<?php echo $user->id ?>"><i class="fas fa-edit"></i></a>
                        <a href="<?php echo base_url("contrasenya_admin/" . $user->id) ?>" class="btn btn-secondary" id="borrar<?php echo $user->id ?>"><i class="fas fa-key"></i></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Usuari</th>
                <th>Correu electrònic</th>
                <th>Tipus usuari</th>
                <th>Actiu</th>
                <th>Nom</th>
                <th>Cognoms</th>
                <th>Tel·lèfon</th>
                <th>Accions</th>
            </tr>
        </tfoot>
    </table>
    <div id="finalForm"></div>
    </form>
</div>



<script>

    var edicioCasella= 0;
    var groupID= 1;

    function editarCasella(id){

        console.log(id);

        if(edicioCasella != -1){

            if(edicioCasella != 0){
                inputToText(edicioCasella);
            }

            // document.getElementById("user" + id).innerHTML= "<input type='text' name='inputuser' id='inputuser"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("user" + id).innerHTML +"'>";
            document.getElementById("email" + id).innerHTML= "<input type='text' name='inputemail' id='inputemail"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("email" + id).innerHTML +"'>";
            
            groupID= document.getElementById("groupHidden" + id).innerHTML;

            document.getElementById("desc" + id).innerHTML= `

            <select name='inputdesc' id='inputdesc`+id+`' onfocus='activarFormulari(`+id+`)'>
                <?php foreach ($allGroups as $group){ ?>
                    <option id='opcio<?php echo $group->id ?>' value='<?php echo $group->id ?>'><?php echo $group->description; ?></option>
                <?php } ?>
            </select>`;



            document.getElementById("opcio" + groupID).selected= true;



            document.getElementById("act" + id).innerHTML= "<input type='text' name='inputact' id='inputact"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("act" + id).innerHTML +"'>";
            document.getElementById("fname" + id).innerHTML= "<input type='text' name='inputfname' id='inputfname"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("fname" + id).innerHTML +"'>";
            document.getElementById("lname" + id).innerHTML= "<input type='text' name='inputlname' id='inputlname"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("lname" + id).innerHTML +"'>";
            document.getElementById("phone" + id).innerHTML= "<input type='text' name='inputphone' id='inputphone"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("phone" + id).innerHTML +"'>";

            edicioCasella=id;

        }

    }

    function inputToText(id){

        // document.getElementById("user" + id).innerHTML=document.getElementById("inputuser" + id).value;
        document.getElementById("email" + id).innerHTML=document.getElementById("inputemail" + id).value;
        document.getElementById("desc" + id).innerHTML=document.getElementById("opcio" + groupID).innerHTML + '<span id="groupHidden'+id+'" hidden>'+groupID+'</span>';
        document.getElementById("act" + id).innerHTML=document.getElementById("inputact" + id).value;
        document.getElementById("fname" + id).innerHTML=document.getElementById("inputfname" + id).value;
        document.getElementById("lname" + id).innerHTML=document.getElementById("inputlname" + id).value;
        document.getElementById("phone" + id).innerHTML=document.getElementById("inputphone" + id).value;

         
    }


    function activarFormulari(id){


        // document.getElementById("inputuser" + id).value;
        document.getElementById("inputemail" + id).value;
        document.getElementById("inputdesc" + id).value;
        document.getElementById("inputact" + id).value;
        document.getElementById("inputfname" + id).value;
        document.getElementById("inputlname" + id).value;
        document.getElementById("inputphone" + id).value;



        console.log("editarButton" + id);
        document.getElementById("editarButton" + id).innerHTML = "<button class='btn btn-success' name='submitNewEntry' type='submit' value='"+id+"'><i class='fas fa-save'></i></button>";



        // document.getElementById("iniciForm").innerHTML = "<form method='POST' action=''>";
        // document.getElementById("finalForm").innerHTML = "</form>";
        


        edicioCasella=-1;



    }





</script>










<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>