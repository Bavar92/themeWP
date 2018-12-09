$ = jQuery;
$(document).ready(function () {
    var width = document.body.clientWidth;

    $("#menuOpen").click(function (e) {
        $(this).toggleClass("opened");
    });
    if (width <= 1024) {
        $("#mainMenu .menu-item-has-children > a").append("<span></span>");
        $("#mainMenu .menu-item-has-children span").click(function () {
            $(this).parent().next().slideToggle(300);
            $(this).toggleClass("active");
            return false;
        });
    }


    //WPCF7
    $(this).on('click', '.wpcf7-not-valid-tip', function () {
        $(this).prev().trigger('focus');
        $(this).fadeOut(500, function () {
            $(this).remove();
        });
    });

    $(window).bind("resize", function () {

    });

    if (!$(".woocommerce-checkout")[0]) {
        $('select').selectric({
            disableOnMobile: false
        });
        $(".wpcf7-form select option:first-of-type").attr('selected', 'true').attr('disabled', 'disabled').attr('value', '0');
    }

    //WOOOOOOOO

    /*initQuantityInput();
    $('body').on('click', '.minus', function (e) {
        var val = parseInt($(this).parent().find('input').val());
        if (val !== 0) {
            $(this).parent().find('input').val(val - 1).change();
        }
    });
    $('body').on('click', '.plus', function (e) {
        var val = parseInt($(this).parent().find('input').val());
        $(this).parent().find('input').val(val + 1).change();

    });
    $(document.body).on('updated_cart_totals', function () {
        initQuantityInput();
    });

    function initQuantityInput() {
        $("form .quantity").prepend('<div class="minus qControls">-</div>');
        $("form .quantity").append('<div class="plus qControls">+</div>');
    }*/

});

// $(window).on('load', function () {
//     if ($("").length > 0) {
//         var swiper = new Swiper("", {
//             loop: true,
//             spaceBetween: 30,
//             autoplay: {
//                 delay: 5000
//             },
//             breakpoints: {
//                 768: {
//                     slidesPerView: 1,
//                     spaceBetween: 10
//                 },
//                 880: {
//                     slidesPerView: 2,
//                     spaceBetween: 20
//                 },
//                 1024: {
//                     slidesPerView: 3,
//                     spaceBetween: 30
//                 }
//             },
//             navigation: {
//                 nextEl: '.fa-angle-right',
//                 prevEl: '.fa-angle-left'
//             }
//         });
//     }
// });