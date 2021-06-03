<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php //echo form_open('news/create'); ?>
<form action="<?php echo base_url('news/create')?>" method="POST">

    <label for="title">Title</label>
    <input type="text" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="text"></textarea><br />

    <input type="submit" name="submit" value="Create news item" />

</form>

<?php 

if (isset($missatge)) 
        echo $missatge; 
        
?>
