<h2><?php echo $title; ?></h2>

<?php foreach ($news as $news_item): ?>

        <h3><?php echo $news_item['title']; ?></h3>
        <div class="main">
                <?php echo $news_item['text']; ?>
        </div>
        <!--
            site_url => http://localhost/daw/ci-demo/index.php/news/XXXXXXXXXX
            base_url => http://localhost/daw/ci-demo/news/XXXXXXXXXX
        -->
        <p><a href="<?php echo site_url('news/'.$news_item['slug']); ?>">View article (site_url)</a></p>
        <p><a href="<?php echo base_url('news/'.$news_item['slug']); ?>">View article (base_url)</a></p>

<?php endforeach; ?>