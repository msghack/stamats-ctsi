<?php

if (is_singular() && get_post_meta(get_the_ID(), '_page_type_interior', true)) {
    get_header("interior");
} elseif (is_page_template('archive.php')) {
    get_header("news");
} else {
    get_header();
}


the_content();


get_footer();

