jQuery(document).ready(function($) {
    $(document).foundation();
    //set up for fancybox
    $(".fancybox")
        .attr('rel', 'casestudy')
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
            },
            helpers: {
                title: {
                    type: "inside"
                }
            }
        });
});
