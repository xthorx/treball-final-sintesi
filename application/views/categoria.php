<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery.dataTables.css")?>">
<script src="<?php echo base_url("assets/js/jquery.dataTables.js")?>"></script>

<h1 class="text-center mb-5"><u><?php echo $titleMain;?></u></h1>



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
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($recursos_categoria as $recurs){ ?>
                <tr>
                    <td><?php echo $recurs->id ?></td>
                    <td><b><a href="<?php echo base_url("/recursos/mostrar/" . $recurs->id)?>"><?php echo $recurs->titol?></a></b></td>
                    <td><?php echo $categoriaName?></td>
                    <td><?php echo $rec_autor[$recurs->id] ?></td>
                    <td><?php echo $recurs->tipus_recurs ?></td>
                    <td><?php echo $recurs->privadesa ?></td>
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
            </tr>
        </tfoot>
    </table>
</div>

<!-- <?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-light p-3 mb-2 container">
        <div class="row text-center">
            <div class="col-1"><p class="m-0 p-0">ID: <?php echo $recurs->id?></p></div>
            <div class="col-5"><p class="m-0 p-0">Titol: <b><?php echo $recurs->titol?></b></p></div>
            <div class="col-3"><p class="m-0 p-0">Categoria: <b><?php echo $rec_categoria?></b></p></div>
            <div class="col-3"><p class="m-0 p-0">Autor: <b><?php echo $rec_autor?></b></p></div>
        </div>
    </div>
<?php } ?> -->


<!-- <?php foreach($recursos_categoria as $recurs){ ?>
    <div class="bg-primary p-3 mb-2">

        <h2><?php echo $recurs->titol?></h2>
        <p class="m-0">Categoria: <?php echo $rec_categoria?></p>
        <p class="m-0">Autor del recurs: <?php echo $rec_autor?></p>

    </div>


    

<?php } ?> -->


<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>