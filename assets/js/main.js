
jQuery(document).ready(function () {
    // owl-dots disabled
    jQuery('.owl-carousel').owlCarousel({
        rtl: true,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
dots:true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
 
});
