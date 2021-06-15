<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery.dataTables.css")?>">
<script src="<?php echo base_url("assets/js/jquery.dataTables.js")?>"></script>

<?php if($this->session->flashdata('message') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <?php echo $this->session->flashdata('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<h1 class="text-center mb-5"><u><?php echo $title;?></u></h1>


<div class="container p-0 mb-2">
    <a href="<?php echo base_url('crear_recurs')?>" class="btn btn-primary">Crear recurs</a>
</div>

<!-- <?php if($this->session->flashdata('errorformulari') != NULL){ ?>
    <div class="alert alert-warning alert-dismissible fade show mx-auto" role="alert" style="position:absolute; top: 10px; left:0; right:0; margin-left: auto; margin-right: auto; max-width: 500px;">
        <strong>Vigila!</strong> Hi ha hagut un error en el teu formulari.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?> -->



<div class="container">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titol</th>
                <th>Categoria</th>
                <th>Autor</th>
                <th>Tipus</th>
                <th>Privadesa</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($recursos_categoria as $recurs){ ?>
                <tr id="recurs<?php echo $recurs->id ?>">
                    <td><?php echo $recurs->id ?></td>
                    <td><b><a href="<?php echo base_url("/recursos/mostrar/" . $recurs->id)?>"><?php echo $recurs->titol?></a></b></td>
                    <td><?php echo $rec_categoria[$recurs->id]?></td>
                    <td><?php echo $rec_autor[$recurs->id] ?></td>
                    <td><?php echo $recurs->tipus_recurs ?></td>
                    <td><?php echo $recurs->privadesa ?></td>
                    <td>
                        <a href="<?php echo base_url("/recursos/editar/" . $recurs->id)?>" class="btn btn-primary">Editar</a>
                        <button class="btn btn-danger" onclick="borrarRecurs('<?php echo $recurs->id?>')">Borrar</button>
                    </td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Titol</th>
                <th>Categoria</th>
                <th>Autor</th>
                <th>Tipus</th>
                <th>Privadesa</th>
                <th>Accions</th>
            </tr>
        </tfoot>
    </table>
</div>


<!-- <?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-light p-3 mb-2 container" id="recurs<?php echo $recurs->id ?>">
        <div class="row text-center">
            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $recurs->id?></p></div>
            <div class="col-2"><p class="m-0 p-0">Titol: <b><a href="<?php echo base_url("/recursos/mostrar/" . $recurs->id)?>"><?php echo $recurs->titol?></a></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Categoria: <b><?php echo $rec_categoria[$recurs->id]?></b></p></div>
            <div class="col-1"><p class="m-0 p-0">Autor: <b><?php echo $rec_autor[$recurs->id]?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Tipus: <b><?php echo $recurs->tipus_recurs?></b></p></div>
            <div class="col-2"><p class="m-0 p-0">Privadesa: <b><?php echo $recurs->privadesa?></b></p></div>
            <div class="col-2">
                <a href="<?php echo base_url("/recursos/editar/" . $recurs->id)?>" class="btn btn-primary">Editar</a>
                <button class="btn btn-danger" onclick="borrarRecurs('<?php echo $recurs->id?>')">Borrar</button>
            </div>
        </div>
    </div>
<?php } ?> -->



<script>

function borrarRecurs(id){

    console.log("erfg");

    var myobj = document.getElementById("recurs" + id);
    myobj.remove();

    $.ajax({
        type:"POST",
        url:"<?php echo base_url("/recursos/borrar/")?>" + id,
        success:function(response){
            // console.log("borrat");
    }})
}




</script>


<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>