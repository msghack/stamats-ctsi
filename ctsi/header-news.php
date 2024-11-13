<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 *
 */

$utility_links = get_field("utility_links", "option");
// var_dump($utility_links);
?>

<!doctype html>
<html class="no-js" <?php language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(array("d-flex", "flex-column", "h-100")) ?>>
    <?php wp_body_open(); ?>
    <div class="skipLink">
        <a class="visually-hidden-focusable Button_Link" href="#header"><span>Skip to header</span></a>
        <a class="visually-hidden-focusable Button_Link" href="#main"><span>Skip to content</span></a>
        <a class="visually-hidden-focusable Button_Link" href="#footer"><span>Skip to footer</span></a>
    </div>

    <header class="header-news" id="header">
        <div class="container d-flex flex-wrap hidden_Mobile UtilityBar_Wrapper">
            <nav class="ms-auto">
                <ul class="nav UtilityBar">
                    <?php foreach ($utility_links as $key => $value) {
                        if ($value["menu_link"]) {
                            ?>
                            <li class="nav-item"><a
                                    href="<?= $value["menu_link"]["url"] ?>"><?= $value["menu_link"]["title"] ?></a></li>
                            <?php
                        }
                        if ($value["search"]) { ?>
                            <li class="nav-item search-box-opener"><a href="javascript:void(0)">Search</a></li>
                        <?php }
                    } ?>


                </ul>
                <div class="desktop-search-box"><?php echo get_field("search_shortcode", "option"); ?></div>

            </nav>
        </div>
        <div class="container d-flex flex-wrap">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="d-flex align-items-center me-lg-auto CTSI_logo"><img
                    src="<?= get_field("header_logo", "option")["url"] ?>"
                    alt="<?= get_field("header_logo", "option")["alt"] ?>"></a>
            <div class="col-lg-auto mobile_menu_wrapper">
                <nav class="navbar navbar-expand-lg MainMenu" role="navigation">
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <?php create_bootstrap_menu("main-menu-links") ?>
                        <div class="col-12 hidden_Desktop searchBar_Wrapper_Mobile">
                            <?php echo get_field("search_shortcode", "option"); ?>
                        </div>
                        <ul class="hidden_Desktop UtilityBar_mobile list-unstyled">
                            <?php foreach ($utility_links as $key => $value) {
                                // var_dump($value["search"]);
                                if ($value["menu_link"]) { ?>
                                    <li><a class=""
                                            href="<?= $value["menu_link"]["url"] ?>"><?= $value["menu_link"]["title"] ?></a>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
