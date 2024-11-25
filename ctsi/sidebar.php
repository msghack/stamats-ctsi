<div class="col-lg-3 col-12 order-lg-2 ps-lg-5">
    <form role="search" class="navbar-form news_search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="input-group add-on">
            <input type="hidden" name="post_type" value="post">
            <label class="form-check-label sr-only sr-only-focusable" for="search">Search</label>
            <input class="form-control news_search_box" placeholder="Search CTSI" name="s" id="search" value="<?php echo get_search_query(); ?>">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><span class="sr-only">Search</span></button>
            </div>
        </div>

        <div class="news_filter">
            <p class="news_filter_heading">Filter By:</p>
            <?php
            $categories = get_categories(array(
                'hide_empty'      => true,
            ));
            // var_dump(get_query_var("category_name"));
            foreach ($categories as $category) {
                $checkboxId = 'check' . $category->term_id;
            ?>
                <div class="form-check checkbox-lg">
                    <input type="checkbox" class="form-check-input" id="<?php echo $checkboxId; ?>" name="category_name" value="<?php echo esc_attr($category->slug); ?>">
                    <label class="form-check-label" for="<?php echo $checkboxId; ?>"><?php echo esc_html($category->name); ?></label>
                </div>
            <?php
            }
            ?>
            <button type="submit" class="news_filter_btn Button_Link">Filter</button>
            <p class="mt-2 resetBtn"><a id="resetfilter" href="javascript:void(0);">Reset Filters</a></p>
        </div>

    </form>
