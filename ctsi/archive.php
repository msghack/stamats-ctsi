<?php
/*
Template Name: News Template
*/

get_header("news");

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged' => $paged,
);

$post_list = new WP_Query($args);

?>

<section class="newsWrapper">
    <div class="container">
        <h1><?= get_the_title(get_the_ID()) ?></h1>
        <div class="row g-0">
            <?php get_sidebar(); ?>

            <div class="col-lg-9 col-12 order-lg -1">
                <?php if ($post_list->have_posts()) : ?>
                    <ul class="list-unstyled newsList">

                        <?php while ($post_list->have_posts()) : $post_list->the_post();
                            if (get_post_thumbnail_id(get_the_ID())) : ?>
                                <li>
                                    <div class="row g-0">
                                        <div class="col-lg-4 col-12">
                                            <div class="news_block_image">
                                                <img src="<?= get_the_post_thumbnail_url(get_the_ID()) ?>" alt="<?= esc_html(get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true)) ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-12 ps-lg-5">
                                            <div class="news_block_text">
                                                <div class="news_block_heading">
                                                    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                                                    <p><?php echo the_time('F j, Y') ?></p>
                                                </div>
                                                <div class="news_block_details">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li>
                                    <div class="row g-0 noImage">
                                        <div class="col-12">
                                            <div class="news_block_text">
                                                <div class="news_block_heading">
                                                    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                                                    <p><?php echo the_time('F j, Y') ?></p>
                                                </div>
                                                <div class="news_block_details">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                    <div class="pagination_div">
                        <?php $total_pages = $post_list->max_num_pages;
                        if ($total_pages > 1) {
                            $current_page = max(1, get_query_var('paged'));
                            echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => '/page/%#%',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'prev_text' => sprintf('<span aria-hidden="true">%s</span><span class="sr-only sr-only-focusable">%s</span>', __('«', 'ctsitheme'), __('Previous Page', 'ctsitheme')),
                                'next_text' => sprintf('<span aria-hidden="true">%s</span><span class="sr-only sr-only-focusable">%s</span>', __('»', 'ctsitheme'), __('Next Page', 'ctsitheme')),
                                'type'  => "list",
                                'before_page_number' => '<span class="sr-only sr-only-focusable">' . __('Page', 'ctsitheme') . ' </span>',
                                'aria_label' => __('Pagination', 'ctsitheme'),
                            ));
                        }
                        ?>
                    </div>
                <?php else : ?>
                    <div class="news_left_content">
                        <div class="no_news_text">No News Found</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

