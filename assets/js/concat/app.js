jQuery(document).ready(function($) {
    $(document).foundation();
    //set up for fancybox
    $(".fancybox")
        .attr('rel', 'gallery')
        .fancybox({
            openEffect : 'none',
            closeEffect: 'none',
            nextEffect: 'none',
            prevEffect: 'none',
            openSpeed: 'fast',
            loop: false,
            preLoad : 3,
            beforeLoad: function () {
                var el, id = $(this.element).data('title-id');
                if (id) {
                    el = $('#' + id);
                    if (el.length) {
                        this.title = el.html()+ '<br><i>Image ' + (this.index + 1) + ' of ' + this.group.length+'</i>';
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
