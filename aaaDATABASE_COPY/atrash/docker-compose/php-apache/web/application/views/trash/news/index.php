<h2><?php echo $title; ?></h2>
<?php foreach ($news as $news_item): ?>

        <h3><?php echo $news_item['title']; ?></h3>
        <div class="main">
                <?php echo $news_item['text']; ?>
        </div>
        <a class="btn btn-primary" href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article</a>
        <a class="btn btn-warning" href="<?php echo base_url('news/edit/'.$news_item['slug']); ?>">Edit article</a>
        <a class="btn btn-danger" href="<?php echo base_url('news/delete/'.$news_item['id']); ?>">Delete article</a>

<?php endforeach; ?>

<div class="mt-5 h2">
        Pàgina: 
        <?php echo $pagination_final ?>
</div>