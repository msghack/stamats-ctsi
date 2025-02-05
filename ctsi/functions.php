<?php


function fonts_load() {

  $font_dir = get_stylesheet_directory()."/assets/fonts";
  $font_exts = [
    'woff2',
    'woff',
    'ttf',
    'otf',
  ];

  $format =   '<link rel="preload" '
            . 'href="%s" '
            . 'as="font" '
            . 'type="font/%s" '
            . 'crossorigin="anonymous"> %s'
            ;
  $fh = opendir( $font_dir );
  while( $entry = readdir( $fh ) ) {
    $ext = mb_strtolower( pathinfo( $entry, PATHINFO_EXTENSION ) );
    if( in_array( $ext, $font_exts ) ) {
      printf( $format, $entry, $ext, PHP_EOL );
    }
  }
}

add_action('wp_head', 'fonts_load', 1);

function styles_enqueues()
{
    wp_enqueue_style('ctsi-bootstrap', get_stylesheet_directory_uri() . "/assets/css/bootstrap.min.css",array(),mt_rand(),'all');
    wp_enqueue_style('ctsi-font', get_stylesheet_directory_uri() . "/assets/css/fonts/stylesheet.css",array(),mt_rand(),'all');
    wp_enqueue_style('ctsi-fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css",array(),mt_rand(),'all');
    wp_enqueue_style('ctsi-owl-carousel', get_stylesheet_directory_uri() . "/assets/css/owl.carousel.min.css",array(),mt_rand(),'all');
    wp_enqueue_style('ctsi-style', get_stylesheet_uri(),array(),mt_rand(),'all');
}
add_action('wp_enqueue_scripts', 'styles_enqueues');

function script_enqueues()
{
    wp_enqueue_script("ctsi-bootstrap-bundle", get_stylesheet_directory_uri() . "/assets/js/bootstrap.bundle.min.js", array("jquery"), mt_rand(),false);
    wp_enqueue_script("ctsi-jqueryui", get_stylesheet_directory_uri() . "/assets/js/jquery-ui.min.js", array("ctsi-bootstrap-bundle"), mt_rand(),false);
    wp_enqueue_script("ctsi-owl-carousel-min", get_stylesheet_directory_uri() . "/assets/js/owl.carousel.min.js", array("ctsi-jqueryui"), mt_rand(),false);
    wp_enqueue_script("ctsi-main", get_stylesheet_directory_uri() . "/assets/js/script.js", array("ctsi-owl-carousel-min"), mt_rand(),false);
}
add_action('wp_enqueue_scripts', 'script_enqueues');

register_nav_menus(array(
    'main-menu-links' => 'Main Menu Links',
    'footer-resource-menu' => 'Footer Resource Menu'
));
function themename_custom_logo_setup()
{
    // $defaults = array(
    //     'height'               => 100,
    //     'width'                => 400,
    //     'flex-height'          => true,
    //     'flex-width'           => true,
    //     'header-text'          => array('site-title', 'site-description'),
    //     'unlink-homepage-logo' => false,
    // );
    // add_theme_support('custom-logo', $defaults);
    add_theme_support('title-tag');
    add_theme_support("site-title");
}
add_action('after_setup_theme', 'themename_custom_logo_setup');

function create_bootstrap_menu($theme_location)
{
    $menu_list = '';
    $column_one = array();
    $column_two = array();
    $menu_id = get_nav_menu_locations()[$theme_location];
    $mega_menus = wpse_nav_menu_2_tree($menu_id);
    // var_dump($mega_menus);


    $menu_list .= '<ul class="navbar-nav">' . "\n";

    foreach ($mega_menus as $key => $value) {
        $column_choice = get_field('column_choice', $value);
        $column_one = array();
        $column_two = array();
        $target =  $value->target === '_blank' ? '_blank' : '_self';
        $left_content_text_area = get_field('left_content_text_area', $value);

        if (count($value->wpse_children) == 0) {
            $menu_list .= '<li class="nav-item"><a class="nav-link" href="javascript:void(0);">' . $value->title . '</a></li>' . "\n";
        } else {
            $menu_list .= '<li class="nav-item dropdown has-megamenu"> <a class="nav-link dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown">' . $value->title . '</a>' . "\n";
            $menu_list .= '<div class="dropdown-menu megamenu" role="menu">' . "\n";
            $menu_list .= '<div class="container">' . "\n";
            $menu_list .= '<div class="closeNavButton_Wrapper hidden_Mobile_header">' . "\n";
            $menu_list .= '<a class="closeNavButton" data-bs-toggle="dropdown"><img src="/wp-content/themes/ctsi/assets/images/close.svg" alt="close"></a>' . "\n";
            $menu_list .= '</div>' . "\n";
            $menu_list .= '<div class="row g-0">' . "\n";

                if ($column_choice == "left" && !empty($left_content_text_area)) {
                    $menu_list .= '<div class="col-lg-4 col-12 megamenu_Details hidden_Mobile_header">' . "\n";
                    $menu_list .= '<div class="col-megamenu">' . "\n";
                    $menu_list .= '<a role="menuitem" target="'.$target.'" href="' . $value->url . '" class="megamenu_Details_Title">' . $value->title . '<svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="#990000" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                            </svg></a>' . $left_content_text_area . "\n";
                    $menu_list .= '</div>' . "\n";
                    $menu_list .= '</div>' . "\n";
                }

            foreach ($value->wpse_children as $key => $children) {
                $column_choice = get_field('column_choice', $children);
                $menu_link_description = get_field('menu_link_description', $children);
                $description = !empty($menu_link_description) ? '<br><span class="hidden_Mobile_header">' . $menu_link_description . '</span>' . "\n" : "";
                $target =  $children->target === '_blank' ? '_blank' : '_self';

                if ($column_choice === 'one') {
                    $column_one[] = '<li><a role="menuitem" target="'.$target.'" href="' . $children->url . '">' . $children->title . '<svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="#990000" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>' . $description . '</a></li>' . "\n";
                }

                if ($column_choice === 'two') {
                    $column_two[] = '<li><a role="menuitem" target="'.$target.'" href="' . $children->url . '">' . $children->title . '<svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="#990000" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                        </svg>' . $description . '</a></li>' . "\n";
                }
            }

            $menu_list .= '<div class="col-lg-4 col-12">' . "\n";
            $menu_list .= '<div class="col-megamenu">' . "\n";
            $menu_list .= '<ul class="list-unstyled">' . "\n";
            $menu_list .= implode("\n", $column_one);
            $menu_list .= '</ul>' . "\n";
            $menu_list .= '</div>' . "\n";
            $menu_list .= '</div>' . "\n";

            if (count($column_two) > 0) {
                $menu_list .= '<div class="col-lg-4 col-12">' . "\n";
                $menu_list .= '<div class="col-megamenu">' . "\n";
                $menu_list .= '<ul class="list-unstyled">' . "\n";
                $menu_list .= implode("\n", $column_two);
                $menu_list .= '</ul>' . "\n";
                $menu_list .= '</div>' . "\n";
                $menu_list .= '</div>' . "\n";
            }

            $menu_list .= '</div>' . "\n";
            $menu_list .= '</div>' . "\n";
            $menu_list .= '</div>' . "\n";
            $menu_list .= '</li>' . "\n";
        }
    }

    $menu_list .= '</ul>' . "\n";

    echo $menu_list;
}


add_theme_support('post-thumbnails', array('post'));


function create_section_navigation()
{

    $current_page_id = get_queried_object_id();

    // Get child pages sorted by title
    $pages_to_display = get_pages(array(
        'child_of' => $current_page_id,
        'parent' => $current_page_id,
        // 'orderby' => 'menu_order',
        'meta_key' => 'include_in_section_navigation',
        'meta_value' => true,
        'sort_column' => 'menu_order',
    ));

    // If no child pages, get siblings and current page
    if (empty($pages_to_display)) {
        $siblings_and_current = get_pages(array(
            'child_of' => wp_get_post_parent_id($current_page_id),
            'parent' => wp_get_post_parent_id($current_page_id),
            // 'orderby' => 'menu_order',
            'meta_key' => 'include_in_section_navigation',
            'meta_value' => true,
            'sort_column' => 'menu_order',
        ));
        $pages_to_display = $siblings_and_current;

        // If no sibling or children pages exist, parent page + its siblings display
        if (count($pages_to_display) == 1) {
            $siblings_and_current =   get_pages(array(
                'child_of' => wp_get_post_parent_id($pages_to_display[0]->post_parent),
                'parent' => wp_get_post_parent_id($pages_to_display[0]->post_parent),
                // 'orderby' => 'menu_order',
                'meta_key' => 'include_in_section_navigation',
                'meta_value' => true,
                'sort_column' => 'menu_order',
            ));
            $pages_to_display = $siblings_and_current;
        }
    }
    // ;
    //print_r($pages_to_display);
    return $pages_to_display;
}





function buildTree(array &$elements, $parentId = 0)
{
    $branch = array();
    foreach ($elements as &$element) {

        if ($element->menu_item_parent == $parentId) {
            $children = buildTree($elements, $element->ID);
            if ($children)
                $element->wpse_children = $children;
            else
                $element->wpse_children = array();
            $branch[$element->ID] = $element;
            unset($element);
        }
    }
    return $branch;
}
function wpse_nav_menu_2_tree($menu_id)
{
    $items = wp_get_nav_menu_items($menu_id);
    return  $items ? buildTree($items, 0) : null;
}




add_filter('acf/fields/wysiwyg/toolbars', 'my_toolbars');
function my_toolbars($toolbars)
{
    $toolbars['Full'][1][] = 'styleselect';
    return $toolbars;
}

function my_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

function my_mce_before_init_insert_formats($init_array)
{
    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'Button_Link',
        ),
    );
    $init_array['style_formats'] = wp_json_encode($style_formats);
    return $init_array;
}
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');

function year_shortcode()
{
    $year = date_i18n('Y');
    return $year;
}
add_shortcode('year', 'year_shortcode');

function custom_breadcrumb()
{
    $post_id = get_queried_object_id();
    $breadcrumbs = array();
    while ($post_id) {
        $page = get_post($post_id);
        array_unshift($breadcrumbs, array('title' => get_the_title($post_id), 'url' => get_permalink($post_id), 'post_id' => $post_id));
        $post_id = $page->post_parent;
    }
    array_unshift($breadcrumbs, array('title' => get_the_title(get_option('page_on_front')), 'url' => esc_url(home_url('/')), 'post_id' => get_option('page_on_front')));
    echo '<nav class="breadcrumb_Nav"><ol class="breadcrumb">';
    $count = count($breadcrumbs);

    // print_r($breadcrumbs);
    foreach ($breadcrumbs as $key => $crumb) {
        if ($crumb['url']) {
            if ($key == 0) {
                echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . get_the_title(get_option('page_on_front')) . '</a></li>';
            }
            elseif ($key == $count - 2 ) {
                if($crumb['post_id'] == get_option('page_on_front')){
                    echo '';
                }else{
                    echo '<li class="breadcrumb-item"><a href="' . esc_url($crumb['url']) . '">' . esc_html($crumb['title']) . '</a></li>';
                }
                // Other items with links
            } elseif($key == $count - 1) {
                // Last item without a link
                echo '<li class="breadcrumb-item active">' . esc_html($crumb['title']) . '</li>';
            }
        }
    }
    echo '</ol></nav>';
}
add_action('custom_breadcrumb', 'custom_breadcrumb');

add_action('admin_print_styles', 'wpdocs_admin_column_styles');

function wpdocs_admin_column_styles()
{
    $custom_css = '<style>.edit-post-layout__metaboxes {
    display : none;
  }</style>';

    echo $custom_css;
}



function custom_enqueue_block_editor_assets()
{
    wp_enqueue_script(
        'custom-block-filter',
        get_template_directory_uri() . '/assets/js/news-template.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        mt_rand(),
        true
    );
}
add_action('enqueue_block_editor_assets', 'custom_enqueue_block_editor_assets');

function wpdocs_excerpt_more($more)
{
    if (!is_single()) {
        $more = sprintf(
            '<br><a class="Button_Link" href="%1$s">%2$s</a>',
            get_permalink(get_the_ID()),
            __('Read More »', 'ctsi-theme')
        );
    }
    return $more;
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');


// function custom_generate_excerpt($content, $length = 55) {

//     $text = strip_shortcodes(wp_strip_all_tags($content));
//     $words = explode(' ', $text);
//     if (count($words) > $length) {
//         $excerpt = array_slice($words, 0, $length);
//         $excerpt = implode(' ', $excerpt) . sprintf(
//             '<br><a class="Button_Link" href="%1$s">%2$s</a>',
//             get_permalink(get_the_ID()),
//             __('Read More', 'ctsi-theme')
//         );
//     } else {
//         $excerpt = $text;
//     }
//     return $excerpt;
// }
// function custom_get_the_excerpt($post) {
//     if (has_excerpt($post->ID)) {
//         return get_the_excerpt($post->ID);
//     } else {
//         $content = get_the_content($post->ID);
//         return custom_generate_excerpt($content);
//     }
// }
// function custom_excerpt_filter($excerpt) {
//     global $post;
//     return custom_get_the_excerpt($post);
// }

// add_filter('get_the_excerpt', 'custom_excerpt_filter');


// Add this to your theme's functions.php file

function custom_block_excerpt($excerpt)
{
    if (has_block('custom/container', get_the_content())) {
        // Extract content from your custom container block
        $content = get_the_content();
        // Use a regular expression to match your custom block
        if (preg_match('/<!-- wp:custom\/container -->(.*?)<!-- \/wp:custom\/container -->/s', $content, $matches)) {
            $content_without_h1 = preg_replace('/<h1[^>]*>.*?<\/h1>/is', '', $matches[1]);

            // Generate excerpt without <h1> content
            $excerpt = wp_trim_words($content_without_h1, 55); // Adjust the number of words as needed
        }
        $excerpt .=  sprintf(
            '<br><a class="Button_Link" href="%1$s">%2$s</a>',
            get_permalink(get_the_ID()),
            __('Read More', 'ctsi-theme')
        );
    }
    return $excerpt;
}

//
// disable admin email verification
add_filter( 'admin_email_check_interval', '__return_false' );

