<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php //echo form_open('news/create'); ?>
<form action="<?php echo base_url('news/edit/' . $slug)?>" method="POST">

    <label for="title">Title</label>
    <input type="text" name="title" value="<?php echo $title_toEdit; ?>" /><br />
    <input type="text" name="id" value="<?php echo $id_toEdit; ?>" hidden/>

    <label for="text">Text</label>
    <textarea name="text"><?php echo $text_toEdit; ?></textarea><br />

    <input type="submit" name="submit" value="Edit item" />

</form>

<?php 

if (isset($missatge)) 
        echo $missatge; 
        
?>
