jQuery(document).ready(function($) {
    'use strict';

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    /**
     * Property colorbox
     */
    $("a[href$='png'], a[href$='jpg']").not('.ignore-colorbox').colorbox({
        rel: $(this).attr('rel'),
        maxWidth: '90%',
        maxHeight: '90%'
    });

    $("select").each(function() {
        $(this).wrap( "<div class='select-wrapper'></div>" );
    });

    /**
     * Property gallery
     */
    if ($('.property-gallery-index').length != 0) {
        $('.property-gallery-index').owlCarousel({
            items: 5,
            nav: true,
            dots: true,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
        });
    }

    $('.property-gallery-list-item a').on('click', function(e) {
        e.preventDefault();

        var link = $(this).attr('rel');
        $('.property-gallery-preview img').attr('src', link);
        $('.property-gallery-preview a').attr('href', link);
    });

//    $('.collapse').collapse();
});
