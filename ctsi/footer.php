<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 */


$menu_id = get_nav_menu_locations()["footer-resource-menu"];
$resource_menu_tree = wpse_nav_menu_2_tree($menu_id);



$social_links =  get_field("social_links", "option");
$footer_copyright_text =  get_field("footer_copyright_text", "option");
$logo_links =  get_field("logo_links", "option");
$desktop_background_image =  get_field("desktop_background_image", "option");
$mobile_background_image =  get_field("mobile_background_image", "option");
$copyright_links =  get_field("copyright_links", "option");
$footer_right_conner_asset  = get_field("footer_right_conner_asset", "option");
// echo "<pre>";
// print_r( $copyright_links );
// echo "</pre>";
?>

</main>
<footer class="footer mt-auto" id="footer" style="background: #F4F6F6 url('<?= $footer_right_conner_asset["url"]?>')  no-repeat right bottom">
    <div class="container">

        <div class="row g-0 FooterMenu_Wrapper">

            <div class="col-lg-3 col-12 FooterLogo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="d-flex align-items-center me-lg-auto CTSI_Footerlogo"><img src="<?= get_field("footer_logo", "option")["url"] ?>" alt="<?= get_field("footer_logo", "option")["alt"] ?>"></a>
            </div>

            <div class="col-lg-9 col-12 ResourceMenu_Wrapper" id="ResourceMenu-accordion">
                <div class="row g-0">
                    <?php foreach ($resource_menu_tree as $key => $value) { ?>
                        <div class="col-lg-4 col-12 ResourceMenu">
                            <span class="ResourceMenuTitle">
                                <span class="hidden_Mobile"><?= $value->post_title ?></span>
                                <button class="accordion-button collapsed hidden_Desktop" type="button" data-bs-toggle="collapse" data-bs-target="#ResourceMenu-<?= $key ?>" aria-expanded="false" aria-controls="ResourceMenu-<?= $key ?>">
                                    <?= $value->post_title ?>
                                </button>
                            </span>

                            <ul id="ResourceMenu-<?= $key ?>" class="list-unstyled" data-bs-parent="#ResourceMenu-accordion">
                                <?php foreach ($value->wpse_children as $key => $childrens) {
                                    if (!empty($childrens->post_title)) {
                                ?>
                                        <li><a href="<?php echo $childrens->url ?>"><?= $childrens->post_title ?></a></li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo $childrens->url ?>"><?= $childrens->title ?></a></li>
                                <?php    }
                                } ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php if (!empty($social_links)) { ?>
            <div class="row g-0 socialIcon_Wrapper">
                <ul class="list-unstyled">
                    <?php
                    foreach ($social_links as $key => $value) {
                        if (!empty($value["icon_selection"])) { ?>

                            <li><a target="<?php echo $value["open_in_new_tab"] ? '_blank' : '_self' ?>" href="<?= $value["social_media_link"] ?>" class="<?= $value["color"]["value"] === "gold" ? "social_Gold" : "social_Blue" ?>"><img src="<?= $value["icon_selection"]["url"] ?>" alt="<?= $value["icon_selection"]["alt"] ?>"></a></li>
                    <?php }
                    }
                    ?>
                </ul>
            </div>
        <?php } ?>
        <?php if (!empty($logo_links)) { ?>
            <div class="row g-0 clientLogo_Wrapper">
                <?php foreach ($logo_links as $key => $value) {
                    // var_dump($value);

                    if (!empty($value["link"]) && !empty($value["image"])) { ?>
                        <div class="col-lg-3 col-12 clientLogo text-center">
                            <span><a target="<?= $value["link"]["target"] ? "_blank" : "_self" ?>" href="<?= $value["link"]["url"] ?>"><img src="<?= $value["image"]["url"] ?>" alt="<?= $value["image"]["alt"] ?>"></a></span>
                        </div>

                <?php }elseif(!empty($value["image"])) { ?>
            <div class="col-lg-3 col-12 clientLogo text-center">
                            <span><img src="<?= $value["image"]["url"] ?>" alt="<?= $value["image"]["alt"] ?>"></span>
                        </div>
        <?php   }
                } ?>

            </div>
        <?php } ?>

        <div class="row g-0 copyright_Wrapper">
            <p><?php echo "&copy; " . do_shortcode("[year]"); ?> <?= $footer_copyright_text ?></p>


            <?php if (!empty($copyright_links)) { ?>

                <ul class="list-unstyled">
                    <?php
                    foreach ($copyright_links as $key => $value) {
                        if (!empty($value["link"])) { ?>
                            <li><a target="<?php echo $value["link"]["target"] === '_blank' ? '_blank' : '_self' ?>" href="<?= $value["link"]["url"] ?>"><?= $value["link"]["title"] ?></a></li>
                    <?php }
                    }
                    ?>
                </ul>

            <?php } ?>

        </div>
    </div>
</footer>
<section class="modalWrapper">
    <div class="container">
        <div class="modal fade" id="ctsi-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe width="640" height="360"  title="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php wp_footer(); ?>
</body>

