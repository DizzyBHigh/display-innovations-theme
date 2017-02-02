jQuery(document).ready(function($) {
    $(document).foundation();
    //set up for fancybox
    $(".fancybox")
        .attr('rel', 'casestudy')
        .attr('rel', 'images')
        .fancybox({
            openEffect : 'none',
            closeEffect: 'none',
            nextEffect: 'none',
            prevEffect: 'none',
            openSpeed: 'fast',
            loop: false,
            preLoad : 3,
            beforeLoad: function () {
                var csel, csid = $(this.element).data('cs-title');
                if (csid) {
                    csel = $('#cs-title-' + csid);
                    if (csel.length) {
                        this.title = csel.html()+ '<br><i>Image ' + (this.index + 1) + ' of ' + this.group.length+'</i>';
                    }
                }
                var iel, iid = $(this.element).data('i-title');
                if (iid) {
                    iel = $('#i-title-' + iid);
                    if (iel.length) {
                        this.title = iel.html()+ '<br><i>Image ' + (this.index + 1) + ' of ' + this.group.length+'</i>';
                    }
                }
            },
            helpers: {
                title: {
                    type: "inside"
                }
            }
        }
    );
    var owl = $(".owl-carousel");
    owl.owlCarousel({
        items: 1,
        center: true,
        loop: true,
        nav: false,
        dots: false,
        autoplay: true,
        //autoplayTimeout:500,
        autoplaySpeed: 1000

    });
    $(".di-prev-slide").on('click', function () {
        owl.trigger('prev.owl.carousel', [1000])
    });
    $(".di-next-slide").on('click', function () {
        owl.trigger('next.owl.carousel', [1000])
    });
});
