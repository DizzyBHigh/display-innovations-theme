jQuery(document).ready(function(e){e(document).foundation(),e(".fancybox").attr("rel","casestudy").attr("rel","images").fancybox({openEffect:"none",closeEffect:"none",nextEffect:"none",prevEffect:"none",openSpeed:"fast",loop:!1,preLoad:3,beforeLoad:function(){var t,n=e(this.element).data("cs-title");n&&(t=e("#cs-title-"+n),t.length&&(this.title=t.html()+"<br><i>Image "+(this.index+1)+" of "+this.group.length+"</i>"));var i,o=e(this.element).data("i-title");o&&(i=e("#i-title-"+o),i.length&&(this.title=i.html()+"<br><i>Image "+(this.index+1)+" of "+this.group.length+"</i>"))},helpers:{title:{type:"inside"}}})}),function(){var e=navigator.userAgent.toLowerCase().indexOf("webkit")>-1,t=navigator.userAgent.toLowerCase().indexOf("opera")>-1,n=navigator.userAgent.toLowerCase().indexOf("msie")>-1;(e||t||n)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var e,t=location.hash.substring(1);/^[A-z0-9_-]+$/.test(t)&&(e=document.getElementById(t),e&&(/^(?:a|select|input|button|textarea)$/i.test(e.tagName)||(e.tabIndex=-1),e.focus()))},!1)}();