jQuery(document).ready(function($) {
    $(document).foundation();
    //set up for fancybox
    $(".fancybox")
        .attr('rel', 'casestudy')
        .attr('rel', 'images')
        .attr('rel', 'video')
        .fancybox({
            openEffect : 'none',
            closeEffect: 'none',
            nextEffect: 'none',
            prevEffect: 'none',
            openSpeed: 'fast',
            loop: false,
            autoSize: false,
            width: 728,
            height: 520,
            //height: 500,
            margin: [20, 60, 20, 60], // Increase left/right margi
            //preLoad : 3,
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
                var vel, vid = $(this.element).data('v-title');
                if (vid) {
                    vel = $('#v-title-' + vid);
                    if (vel.length) {
                        this.title = vel.html() + '<br><i>Video ' + (this.index + 1) + ' of ' + this.group.length + '</i>';
                        $('.fancybox-inner').attr('height', 400);
                        $.fancybox.update()
                    }
                }
            },
            afterLoad: function () {
                // Resize height of fancybox for inline content.
                if (this.type == "inline") {
                    var vid = $(this.element).data('v-title');
                    this.height = $('.videoItem' + vid).height() + 40;
                }
            },
            helpers: {
                title: {
                    type: "inside"
                }
            }
        }
    );
    $.fancybox.update();

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
