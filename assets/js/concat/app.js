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
        });
});
