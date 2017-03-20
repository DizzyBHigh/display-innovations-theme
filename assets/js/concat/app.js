jQuery(document).ready(function($) {
    $(document).foundation();
    //set up for fancybox

    $options = {openEffect : 'none',
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
                /*var vid = $(this.element).data('v-title');
                this.height = $('.videoItem' + vid).height() + 35;

                //get the videoID
                var vidID = $('.videoItem'+vid).attr('id');
                var myPlayer = videojs(vidID);
                console.log(myPlayer);
                //myPlayer.autoplay(true);
                myPlayer.loop(false);
                myPlayer.muted(false);
                myPlayer.play(true);*/
            }
        },
        helpers: {
            title: {
                type: "inside"
            }
        }};

    $(".fancybox").attr('rel', 'casestudy').fancybox($options);
    $(".fancybox").attr('rel', 'images').fancybox($options);
    $(".fancybox").attr('rel', 'video').fancybox($options);


    $.fancybox.update();

    /*var otherVids = $('.videoplayer');
    $.each(otherVids, function(){
        player = videojs(this.id);
        console.log(player);
        player.autoplay(false);
        player.loop(false);
        player.muted(false);
        player.pause(true);
    });*/

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


    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-27695900-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

//hacky stuff to add border round twitter feed
    checkBorders = function(){
         $("#twitter-widget-0").contents().find(".timeline-Widget").css( "border", "1px solid #146BAB").css("margin-top","20px").css('border-radius', '10px');
         $("#twitter-widget-0").contents().find(".timeline-Viewport").css('height', '604px');
         //console.log('checked');
    };
    setInterval(function(){ checkBorders() }, 1000);



});
