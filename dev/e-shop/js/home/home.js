$(function() {
    //----------------------------------------------------------------------------------------------------------
    //----     Reload Function
    //----------------------------------------------------------------------------------------------------------
    loadFeaturedCategory();
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    function loadFeaturedCategory() {
        var $this = $("body").find('#loadFeaturedCategory');
        var url = $this.attr('data-route');
        custom_ajaxFunction(url, $this);
    }
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    function custom_ajaxFunction(url, $divPath, $data = '') {
        $.ajax({
            url: url,
            data: $data,
            type: 'GET',
            dataTYPE: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('input[name=_token]').val()
            },
            beforeSend: function() {},
            success: function(result) {
                if (parseInt(result.status) == 1) {
                    $divPath.html(result.htm);
                }
            },
            complete: function() {
                $("body").find('.custom-loading').hide();
            },
            error: function(jqXhr, textStatus, errorMessage) {

            }
        });
    }
});


// product slider start here
$('.product-type-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
// product slider end here

$('.testimonial-slider').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    dots:true,
    responsive:{
        0:{
            items:1
        },
        767:{
            items:2
        },
        1000:{
            items:3
        }
    }
})

$('.product-view-slider').owlCarousel({
    loop:true,
    margin:30,
    dots:false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})


$('.popular-product-slider-1').owlCarousel({
    loop:true,
    margin:30,
    dots:false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5.5
        }
    }
})
$('.popular-product-slider').owlCarousel({
    loop:true,
    margin:30,
    dots:false,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})


$('.banner-slider').owlCarousel({
    loop:true,
    margin:0,
    autoplay:true,
    autoplayTimeout:4000,
    dots:false,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

