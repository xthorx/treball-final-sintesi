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



<h1 class="text-center"><?php echo $title; ?></h1>

<div class="container">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Alumne</th>
                <th>Correu</th>
                <th>Classes</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($infoUsers as $user){ ?>
                <tr>
                    <td id="user<?php echo $user->id ?>"><?php echo $user->id ?></td>
                    <td id="user<?php echo $user->id ?>"><?php echo $user->username ?></td>
                    <td id="email<?php echo $user->id ?>"><?php echo $user->email ?></td>
                    <td id="desc<?php echo $user->id ?>">
                        <?php 
                        $i= 0;
                        foreach($classesAlumne[$user->id] as $classe){
                            if($i==0){
                                echo $classe->nom;
                                $i++;
                            }else{
                                echo ", ".$classe->nom;
                            }
                            
                        }?>
                    </td>
                    <td><a href="<?php echo base_url("admin/alumnes/" . $user->id) ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
                </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Alumne</th>
                <th>Correu</th>
                <th>Classes</th>
                <th>Accions</th>
            </tr>
        </tfoot>
    </table>
</div>










<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>