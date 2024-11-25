<?php
get_header('news');
?>
<div class="container">
    <?= get_field('content', 'option') ?>
</div>
<?php get_footer();
