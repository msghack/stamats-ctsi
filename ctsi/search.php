<?php
get_header("news");


?>
<section class="newsWrapper">
    <div class="container">
    <h1>Search Results</h1>
        <div class="row g-0">
            <div class="col-12 order-1">
            <form role="search" class="navbar-form news_search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="input-group add-on">
                    <input type="hidden" name="post_type" value="post">
                    <label class="form-check-label sr-only sr-only-focusable" for="search">Search</label>
                    <input class="form-control news_search_box" placeholder="Search CTSI" name="s" id="search" value="<?php echo get_search_query(); ?>">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="sr-only">Search</span></button>
                    </div>
                </div>
            </form>
        </div>
            <div class="col-12 order-2">
                <?php if (have_posts()) : ?>
                        <ul class="list-unstyled newsList">

                            <?php while (have_posts()) : the_post();  if (get_post_thumbnail_id(get_the_ID())) : ?>
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
                                                    <?php //var_dump(get_query_var("post_type"));
                                                     if(get_query_var("post_type") === "post"){ ?>
                                                        <p><?php echo the_time('F j, Y') ?></p>
                                                 <?php   } ?>

                                                </div>
                                                <div class="news_block_details">
                                                    <p> <?php the_excerpt(); ?>
                                                    </p>
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
                                                    <?php //var_dump(get_query_var("post_type"));
                                                     if(get_query_var("post_type") === "post"){ ?>
                                                        <p><?php echo the_time('F j, Y') ?></p>
                                                 <?php   } ?>
                                                </div>
                                                <div class="news_block_details">
                                                    <p> <?php the_excerpt(); ?>
                                                    </p>
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
                        <?php echo paginate_links(array(
                            'base' => preg_replace('/\?.*/', '', get_pagenum_link(1)) . '%_%',
                            'format' => 'page/%#%',
                            'prev_text' => sprintf('<span aria-hidden="true">%s</span><span class="sr-only sr-only-focusable">%s</span>', __('«', 'ctsitheme'), __('Previous Page', 'ctsitheme')),
                            'next_text' => sprintf('<span aria-hidden="true">%s</span><span class="sr-only sr-only-focusable">%s</span>', __('»', 'ctsitheme'), __('Next Page', 'ctsitheme')),
                            'type'  => "list",
                            'before_page_number' => '<span class="sr-only ">' . __('Page', 'ctsitheme') . ' </span>',
                            'aria_label' => __('Pagination', 'ctsitheme'),
                        ));
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

<?php
get_footer();