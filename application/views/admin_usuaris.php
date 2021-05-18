<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>






<div class="container">
    <table id="example" class="display" style="width:100%">
        <thead>
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
        </thead>
        <tbody>
            <?php foreach($infoUsers as $user){ ?>
                <tr>
                    <td id="user<?php echo $user->id ?>"><?php echo $user->username ?></td>
                    <td id="email<?php echo $user->id ?>"><?php echo $user->email ?></td>
                    <td id="desc<?php echo $user->id ?>"><?php echo $user->description ?></td>
                    <td id="act<?php echo $user->id ?>"><?php echo $user->active ?></td>
                    <td id="fname<?php echo $user->id ?>"><?php echo $user->first_name ?></td>
                    <td id="lname<?php echo $user->id ?>"><?php echo $user->last_name ?></td>
                    <td id="phone<?php echo $user->id ?>"><?php echo $user->phone ?></td>
                    <td>
                        <button class="btn btn-primary" id="editar<?php echo $user->id ?>" onclick="editarCasella(<?php echo $user->id ?>)">Editar</button>
                        <button class="btn btn-danger" id="borrar<?php echo $user->id ?>">Borrar</button>
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
</div>



<script>

    var edicioCasella= 0;

    function editarCasella(id){

        console.log(id);

        if(edicioCasella != 0){
            inputToText(edicioCasella);
        }

        document.getElementById("user" + id).innerHTML= "<input type='text' id='inputuser"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("user" + id).innerHTML +"'>";
        document.getElementById("email" + id).innerHTML= "<input type='text' id='inputemail"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("email" + id).innerHTML +"'>";
        document.getElementById("desc" + id).innerHTML= "<input type='text' id='inputdesc"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("desc" + id).innerHTML +"'>";
        document.getElementById("act" + id).innerHTML= "<input type='text' id='inputact"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("act" + id).innerHTML +"'>";
        document.getElementById("fname" + id).innerHTML= "<input type='text' id='inputfname"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("fname" + id).innerHTML +"'>";
        document.getElementById("lname" + id).innerHTML= "<input type='text' id='inputlname"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("lname" + id).innerHTML +"'>";
        document.getElementById("phone" + id).innerHTML= "<input type='text' id='inputphone"+id+"' class='form-control' onfocus='activarFormulari("+id+")' value='"+ document.getElementById("phone" + id).innerHTML +"'>";

        edicioCasella=id;

    }

    function inputToText(id){

        document.getElementById("user" + id).innerHTML=document.getElementById("inputuser" + id).value;
        document.getElementById("email" + id).innerHTML=document.getElementById("inputemail" + id).value;
        document.getElementById("desc" + id).innerHTML=document.getElementById("inputdesc" + id).value;
        document.getElementById("act" + id).innerHTML=document.getElementById("inputact" + id).value;
        document.getElementById("fname" + id).innerHTML=document.getElementById("inputfname" + id).value;
        document.getElementById("lname" + id).innerHTML=document.getElementById("inputlname" + id).value;
        document.getElementById("phone" + id).innerHTML=document.getElementById("inputphone" + id).value;

         
    }


    function activarFormulari(id){


        document.getElementById("inputuser" + id).value;
        document.getElementById("inputemail" + id).value;
        document.getElementById("inputdesc" + id).value;
        document.getElementById("inputact" + id).value;
        document.getElementById("inputfname" + id).value;
        document.getElementById("inputlname" + id).value;
        document.getElementById("inputphone" + id).value;


        document.getElementById("editar" + id).innerHTML= "Guardar";
        document.getElementById("editar" + id).className = "btn btn-success";



    }





</script>










<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>