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
            
            <?php foreach($totsRecursos as $recurs){ ?>
                <tr id="recurs<?php echo $recurs->id ?>">
                    <td><?php echo $recurs->id ?></td>
                    <td><b><a href="<?php echo base_url("/recursos/mostrar/" . $recurs->id)?>"><?php echo $recurs->titol?></a></b></td>
                    <td><?php echo $rec_categoria[$recurs->id]?></td>
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


<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>