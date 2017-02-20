jQuery(document).ready(function (e) {
    e(document).foundation(), e(".fancybox").attr("rel", "casestudy").attr("rel", "images").attr("rel", "video").fancybox({
        openEffect: "none",
        closeEffect: "none",
        nextEffect: "none",
        prevEffect: "none",
        openSpeed: "fast",
        loop: !1,
        autoSize: !1,
        width: 728,
        height: 520,
        margin: [20, 60, 20, 60],
        beforeLoad: function () {
            var t, i = e(this.element).data("cs-title");
            i && (t = e("#cs-title-" + i), t.length && (this.title = t.html() + "<br><i>Image " + (this.index + 1) + " of " + this.group.length + "</i>"));
            var n, o = e(this.element).data("i-title");
            o && (n = e("#i-title-" + o), n.length && (this.title = n.html() + "<br><i>Image " + (this.index + 1) + " of " + this.group.length + "</i>"));
            var a, l = e(this.element).data("v-title");
            l && (a = e("#v-title-" + l), a.length && (this.title = a.html() + "<br><i>Video " + (this.index + 1) + " of " + this.group.length + "</i>", e(".fancybox-inner").attr("height", 400), e.fancybox.update()))
        },
        afterLoad: function () {
            if ("inline" == this.type) {
                var t = e(this.element).data("v-title");
                this.height = e(".videoItem" + t).height() + 35;
                var i = e(".videoItem" + t).attr("id"), n = videojs(i);
                console.log(n), n.loop(!1), n.muted(!1), n.play(!0)
            }
        },
        helpers: {title: {type: "inside"}}
    }), e.fancybox.update();
    var t = e(".videoplayer");
    e.each(t, function () {
        player = videojs(this.id), console.log(player), player.autoplay(!1), player.loop(!1), player.muted(!1), player.pause(!0)
    });
    var i = e(".owl-carousel");
    i.owlCarousel({
        items: 1,
        center: !0,
        loop: !0,
        nav: !1,
        dots: !1,
        autoplay: !0,
        autoplaySpeed: 1e3
    }), e(".di-prev-slide").on("click", function () {
        i.trigger("prev.owl.carousel", [1e3])
    }), e(".di-next-slide").on("click", function () {
        i.trigger("next.owl.carousel", [1e3])
    })
}), function () {
    var e = navigator.userAgent.toLowerCase().indexOf("webkit") > -1, t = navigator.userAgent.toLowerCase().indexOf("opera") > -1, i = navigator.userAgent.toLowerCase().indexOf("msie") > -1;
    (e || t || i) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function () {
        var e, t = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(t) && (e = document.getElementById(t), e && (/^(?:a|select|input|button|textarea)$/i.test(e.tagName) || (e.tabIndex = -1), e.focus()))
    }, !1)
}();