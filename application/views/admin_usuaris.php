<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>






<div class="container">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Usuari</th>
                <th>Correu electrònic</th>
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
                    <td><?php echo $user->username ?></td>
                    <td><?php echo $user->email ?></td>
                    <td><?php echo $user->active ?></td>
                    <td><?php echo $user->first_name ?></td>
                    <td><?php echo $user->last_name ?></td>
                    <td><?php echo $user->phone ?></td>
                    <td>
                        <button class="btn btn-primary">Editar</button>
                        <button class="btn btn-danger">Borrar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Usuari</th>
                <th>Correu electrònic</th>
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

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>