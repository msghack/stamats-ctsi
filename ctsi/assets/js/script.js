jQuery(document).ready(function () {
  jQuery(".Button_Link").wrapInner('<span></span>');
  jQuery(".wp-block-button a.wp-block-button__link").wrapInner('<span></span>');




  //search and filter jquery start


  //   console.log(searchbutton)



  jQuery("li.search-box-opener").on("click", function () {
    jQuery(this).addClass("active");
    jQuery("div.desktop-search-box .searchandfilter").append("<button id='formReset' class='form-reset-class'>Close</button>");
    jQuery(".desktop-search-box").show("slide", { direction: "right" }, 500, function () {
      jQuery('.desktop-search-box input[type="text"]').focus();
    });

  });

  // jQuery("form.searchandfilter").attr("action", window.location.origin);


  jQuery(document).on("click", "#formReset", function (event) {
    event.preventDefault();
    jQuery(".desktop-search-box").hide("slide", { direction: "right" }, 500);
    jQuery("form.searchandfilter").trigger("reset");
  });

  jQuery(document).on("mouseup", function (event) {
    if (jQuery("li.search-box-opener").hasClass("active")) {
      var pol = jQuery(".desktop-search-box");
      var box = jQuery(".searchandfilter");
      var listing = jQuery(".searchandfilter ul");
      var search_button_submit = jQuery(".searchandfilter input[name='ofsubmitted']");
      var search_button_search = jQuery(".searchandfilter input[name='ofsearch']");
      // console.log(event.target.childNodes[0]);
      // console.log(listing);
      if (event.target.form != box[0] && event.target != listing[0] && event.target != search_button_submit[0] && event.target.childNodes[0] != search_button_search[0] && event.target.childNodes[0] != search_button_submit[0]) {
        pol.hide("slide", { direction: "right" }, 500);
        jQuery("li.search-box-opener").removeClass("active");
      }
    }
  });

  jQuery(document).on("keyup", function (evt) {
    if (evt.keyCode == 27 && jQuery("li.search-box-opener").hasClass("active")) {
      jQuery(".desktop-search-box").hide("slide", { direction: "right" }, 500);
    }
  });

  //search and filter jquery end


  jQuery(window).trigger('resize');





  //  Table jQuery start

  jQuery(".is-style-vertical-table tr td:nth-child(1)").each(function () {
    jQuery(this).replaceWith("<th>" + jQuery(this).html() + "</th>");
  });

  jQuery(".is-style-simple-table tr th:nth-child(1)").replaceWith(function () {
    return jQuery("<td>", {
      class: "td-empty-top-cell",
      html: jQuery(this).html(),
    });
  });
  jQuery(".is-style-simple-table tbody tr td:nth-child(1)").each(function () {
    jQuery(this).replaceWith("<th>" + jQuery(this).text() + "</th>");
  });

  jQuery(".wp-block-table").each(function () {
    var figcaptionElement = jQuery(this).find("figcaption").detach();
    jQuery(this).after(figcaptionElement);
  });

  jQuery(".wp-block-table").each(function () {
    // console.log(figcaptionElement);
    var figcaptionElement = jQuery(this).find("figure figcaption").detach();
    // console.log(figcaptionElement);
    jQuery(this).find("figure").after(figcaptionElement);
  });

  //  Table jQuery End

  //modal jquery start


  jQuery(".mediaShowcase .playButton button").on("click", function () {
    var iframe_src = jQuery(this).data("iframe-link") + "&amp;autoplay=1";
    var iframe_height = jQuery(this).data("iframe-height");
    var iframe_width = jQuery(this).data("iframe-width");
    var iframe_title = jQuery(this).data("iframe-title");
    jQuery(".modalWrapper .modal").attr("aria-labelledby", iframe_title);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("src", iframe_src);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("height", iframe_height);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("width", iframe_width);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("title", iframe_title);
  });

  jQuery(".image-carousel .item .playButton button.video_play").on("click", function (event) {
    event.stopPropagation();  // Stop the event from propagating to the anchor
    event.preventDefault();   // Prevent the default anchor behavior
    var iframe_src = jQuery(this).data("iframe-link") + "&autoplay=1";
    var iframe_height = jQuery(this).data("iframe-height");
    var iframe_width = jQuery(this).data("iframe-width");
    var iframe_title = jQuery(this).data("iframe-title");
    jQuery(".modalWrapper .modal").attr("aria-labelledby", iframe_title);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("src", iframe_src);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("height", iframe_height);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("width", iframe_width);
    jQuery(".modalWrapper .modal .modal-dialog .modal-body iframe").attr("title", iframe_title);
  });


  jQuery(".modalWrapper .modal").on("hide.bs.modal", function () {
    jQuery(this).find(".modal-dialog .modal-body iframe").attr("src", "");
  });

  //modal jquery end

  //image carousel jquery start
  var owl = jQuery('.image-carousel');
  owl.owlCarousel({
    autoPlay: 3000,
    navigation: true,
    pagination: false,
    items: 4,
    stagePadding: 67,
    loop: false,
    nav: true,
    margin: 0,
    navElement: 'button',
    responsive: {
      0: {
        items: 1,
      },
      481: {
        items: 2,
      },
      768: {
        items: 3,
      },
      1024: {
        items: 4,
        stagePadding: 60.685,
      },
      1280: {
        stagePadding: 77.5,
      },
      1366: {
        stagePadding: 64.5,
      },
      1536: {
        stagePadding: 80.265,
      },
      1920: {
        stagePadding: 103.305,
      },
    }
  });

  // Add tabindex to each carousel item for keyboard navigation
  // jQuery(".image-carousel .owl-item").attr('tabindex', '0');

  // Focus event listener to navigate carousel

  // owl.on('changed.owl.carousel', function(event) {
  //   var items = event.item.count;     // Number of items
  //   var item  = event.item.index;     // Position of the current item
  //   var owlStage = jQuery('.owl-stage');
  //   var focusedItem = jQuery('.owl-item').eq(item);

  //   // Scroll to the focused item
  //   owlStage.animate({
  //     scrollLeft: focusedItem.position().left
  //   }, 500); // Adjust animation speed as needed
  // });

  owl.on('focusin keyup', '.owl-item', function (event) {

    var $item = jQuery(this);
    var isVisible = $item.hasClass('active');
    // Check if the item is not visible
    if (!isVisible) {
      // Check for Shift + Tab key combination
      if (event.shiftKey && event.key === "Tab") {
        jQuery(".image-carousel").trigger('prev.owl.carousel');
        event.preventDefault(); // Prevent default behavior
      }
      // Check for Tab key
      else if (!event.shiftKey && event.key === "Tab") {
        jQuery(".image-carousel").trigger('next.owl.carousel');
        event.preventDefault(); // Prevent default behavior
      }
    }
  });


  owl.on('click', '.owl-item a', function (e) {
    if(jQuery(this).parents(".owl-item").hasClass("active")){
      return;
    }
    e.preventDefault();
    // console.log()
    if (jQuery(this).parents(".owl-item").prev().hasClass("active")) {
      jQuery(".image-carousel").trigger('next.owl.carousel');
    } else if (jQuery(this).parents(".owl-item").next().hasClass("active")) {
      jQuery(".image-carousel").trigger('prev.owl.carousel');
    }
  });


  setTimeout(function(){
    var arrow_Top_Height = jQuery('.ImageCard_Img').height() + 78;
    console.log(arrow_Top_Height);
    jQuery('.owl-carousel .owl-nav .owl-prev').css('top', arrow_Top_Height + 'px')
    jQuery('.owl-carousel .owl-nav .owl-next').css('top', arrow_Top_Height + 'px');
    jQuery('.playButton .video_play').css('top', arrow_Top_Height - 130 + 'px');
  }, 2000);


  // jQuery(".owl-stage .owl-item a").attr("tabindex", "-1");
  //     jQuery(".owl-stage .owl-item a .playButton button").attr("tabindex", "-1");
  //     jQuery(".owl-stage .owl-item.active a").attr("tabindex", "0");
  //     jQuery(".owl-stage .owl-item.active a .playButton button").attr("tabindex", "0");

  //     jQuery("button.owl-next").on("click focus", function () {
  //       jQuery(".owl-stage .owl-item a").attr("tabindex", "-1");
  //       jQuery(".owl-stage .owl-item a .playButton button").attr("tabindex", "-1");
  //       jQuery(".owl-stage .owl-item.active a").attr("tabindex", "0");
  //       jQuery(".owl-stage .owl-item.active a .playButton button").attr("tabindex", "0");
  //     });
  //image carousel jquery end

  function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  }

  jQuery('.news_search').submit(function (e) {
    e.preventDefault();
    //  console.log(jQuery(this).find('.news_search_box').val())
    var selectedCategories = jQuery('.form-check-input:checked').map(function () {
      return this.value;
    }).get();
    // console.log("working")
    var categoriesQueryString = selectedCategories.join('%2C');
    var newAction = jQuery(this).attr('action') + '?post_type=post&s=' + encodeURIComponent(jQuery(this).find('.news_search_box').val()) + '&category_name=' + categoriesQueryString;
    window.location.href = newAction;
  });



  jQuery(".news_filter .form-check-input").each(function () {
    if (getUrlVars().category_name?.split("%2C").includes(jQuery(this).val())) {
      jQuery(this).prop("checked", true);
    }
  });

  jQuery(document).on("click", "#resetfilter", function () {
    jQuery("form.news_search").trigger("reset")
    var newAction = jQuery(".news_search").attr('action') + '?post_type=post&s=';
    window.location.href = newAction;
  });

  //accordian
  jQuery(".accordion_Wrapper .accordion-button").click(function () {
    var $element = jQuery(this); // Store the reference to the clicked '.scroll_to_top' element.
    setTimeout(function () {
      // Calculate the target scroll position by getting the top offset of the clicked element.
      var targetScrollTop = $element.offset().top - 0;
      // Scroll to the target element using $('html, body').
      jQuery('html, body').animate({
        scrollTop: targetScrollTop
      }, 100); // Scroll animation duration: 1000 milliseconds (1 second).
    }, 300); // Delay before starting the animation: 3000 milliseconds (3 seconds).
  });

});

// function adjustArrowPosition() {
//   console.log("Resize Triggered");
//   var img_card_height = jQuery('.ImageCard_Img').outerHeight();
//   var img_card_Theight = jQuery('.ImageCard_Img_Title').outerHeight();
//   console.log(img_card_height, img_card_Theight);
//   var arrow_Top_Height = img_card_height + img_card_Theight;
//   console.log(arrow_Top_Height);
//   jQuery('.owl-carousel .owl-nav .owl-prev').css('top', arrow_Top_Height + 'px');
//   jQuery('.owl-carousel .owl-nav .owl-next').css('top', arrow_Top_Height + 'px');
//   jQuery('.playButton .video_play').css('top', arrow_Top_Height - 130 + 'px');
// }

// function debounce(func, wait) {
//   let timeout;
//   return function () {
//     const context = this, args = arguments;
//     clearTimeout(timeout);
//     timeout = setTimeout(() => func.apply(context, args), wait);
//   };
// }

jQuery(window).on('resize', function () {
  if (window.matchMedia("(max-width: 992px)").matches) {
    jQuery(".ResourceMenu_Wrapper").addClass('accordion accordion-flush');
    jQuery(".ResourceMenu").addClass('accordion-item');
    jQuery(".ResourceMenuTitle").addClass('accordion-header');
    jQuery(".ResourceMenu_Wrapper ul.list-unstyled").addClass('accordion-collapse collapse');
  }
  else {
    jQuery(".ResourceMenu_Wrapper").removeClass('accordion accordion-flush');
    jQuery(".ResourceMenu").removeClass('accordion-item');
    jQuery(".ResourceMenuTitle").removeClass('accordion-header');
    jQuery(".ResourceMenu_Wrapper ul.list-unstyled").removeClass('accordion-collapse collapse');
  }

  var arrow_Top_Height = jQuery('.ImageCard_Img').height() + 78;
  console.log(arrow_Top_Height);
  jQuery('.owl-carousel .owl-nav .owl-prev').css('top', arrow_Top_Height + 'px')
  jQuery('.owl-carousel .owl-nav .owl-next').css('top', arrow_Top_Height + 'px');
  jQuery('.playButton .video_play').css('top', arrow_Top_Height - 130 + 'px');


});




