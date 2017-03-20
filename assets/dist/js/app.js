jQuery(document).ready(function (t) {
    t(document).foundation(), $options = {
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
            var e, n = t(this.element).data("cs-title");
            n && (e = t("#cs-title-" + n), e.length && (this.title = e.html() + "<br><i>Image " + (this.index + 1) + " of " + this.group.length + "</i>"));
            var i, o = t(this.element).data("i-title");
            o && (i = t("#i-title-" + o), i.length && (this.title = i.html() + "<br><i>Image " + (this.index + 1) + " of " + this.group.length + "</i>"));
            var a, s = t(this.element).data("v-title");
            s && (a = t("#v-title-" + s), a.length && (this.title = a.html() + "<br><i>Video " + (this.index + 1) + " of " + this.group.length + "</i>", t(".fancybox-inner").attr("height", 400), t.fancybox.update()))
        },
        afterLoad: function () {
            "inline" == this.type
        },
        helpers: {title: {type: "inside"}}
    }, t(".fancybox").attr("rel", "casestudy").fancybox($options), t(".fancybox").attr("rel", "images").fancybox($options), t(".fancybox").attr("rel", "video").fancybox($options), t.fancybox.update();
    var e = t(".owl-carousel");
    e.owlCarousel({
        items: 1,
        center: !0,
        loop: !0,
        nav: !1,
        dots: !1,
        autoplay: !0,
        autoplaySpeed: 1e3
    }), t(".di-prev-slide").on("click", function () {
        e.trigger("prev.owl.carousel", [1e3])
    }), t(".di-next-slide").on("click", function () {
        e.trigger("next.owl.carousel", [1e3])
    });
    var n = n || [];
    n.push(["_setAccount", "UA-27695900-1"]), n.push(["_trackPageview"]), function () {
        var t = document.createElement("script");
        t.type = "text/javascript", t.async = !0, t.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
        var e = document.getElementsByTagName("script")[0];
        e.parentNode.insertBefore(t, e)
    }(), checkBorders = function () {
        t("#twitter-widget-0").contents().find(".timeline-Widget").css("border", "1px solid #146BAB").css("margin-top", "20px").css("border-radius", "10px"), t("#twitter-widget-0").contents().find(".timeline-Viewport").css("height", "604px")
    }, setInterval(function () {
        checkBorders()
    }, 1e3)
}), function () {
    var t = navigator.userAgent.toLowerCase().indexOf("webkit") > -1, e = navigator.userAgent.toLowerCase().indexOf("opera") > -1, n = navigator.userAgent.toLowerCase().indexOf("msie") > -1;
    (t || e || n) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function () {
        var t, e = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e), t && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus()))
    }, !1)
}();