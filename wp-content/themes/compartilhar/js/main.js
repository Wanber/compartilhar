"use strict";

var size_nav = 40;

jQuery(function ($) {

    //clickable divs
    $(".clickable").click(function () {
        window.location = $(this).data("href");
    });

    //scroll suave em links para sessoes
    $('a[href^="#"]').on('click', function (e) {
        try {
            e.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top - size_nav}, 800);
        } catch (e) {
        }
    });

    //abrir aviso newssletter
    var newslleter = $('.mc4wp-alert');

    if (newslleter.length) {

        var msg = $('.mc4wp-alert p').text();
        var tipo = 'info';

        if (newslleter.hasClass('mc4wp-error'))
            tipo = 'error';
        if (newslleter.hasClass('mc4wp-success'))
            tipo = 'success';
        if (newslleter.hasClass('mc4wp-notice'))
            tipo = 'info';

        swal({
            text: msg,
            type: tipo,
            confirmButtonText: 'OK'
        })
    }
});

function refreshCourseList(base_url) {

    jQuery('#input-curso').attr('value', '');

    var course_type_id = jQuery('#input-tipo-curso option:selected').attr('title');
    var course_area_id = jQuery('#input-area option:selected').attr('title');
    var course_type_alias = jQuery('#input-tipo-curso option:selected').attr('value');
    var course_area_alias = jQuery('#input-area option:selected').attr('value');

    jQuery("#form-curso").attr('action', base_url + course_type_alias + '/' + course_area_alias);

    var where = '&limit=999&where=cdcurso_area=' + course_area_id + ' AND cdtpcurso=' + course_type_id;
    where += " AND ativo='S' AND ativosite='S'";

    jQuery.get("https://api-legacy.institutoprominas.com.br/ucam/courses/?select=nmcurso" + where, function (data) {

        var course_data = data.data;
        var course_names = [];

        for (var i = 0; i < course_data.length; i++)
            course_names.push(course_data[i].nmcurso);

        jQuery("#input-curso").autocomplete({source: course_names});

    });
}

function r(f) {
    /in/.test(document.readyState) ? setTimeout('r(' + f + ')', 9) : f()
}

r(function () {
    if (!document.getElementsByClassName) {
        // IE8 support
        var getElementsByClassName = function (node, classname) {
            var a = [];
            var re = new RegExp('(^| )' + classname + '( |$)');
            var els = node.getElementsByTagName("*");
            for (var i = 0, j = els.length; i < j; i++)
                if (re.test(els[i].className)) a.push(els[i]);
            return a;
        }
        var videos = getElementsByClassName(document.body, "youtube");
    }
    else {
        var videos = document.getElementsByClassName("youtube");
    }

    var nb_videos = videos.length;
    for (var i = 0; i < nb_videos; i++) {
        // Based on the YouTube ID, we can easily find the thumbnail image
        videos[i].style.backgroundImage = 'url(https://i.ytimg.com/vi/' + videos[i].id + '/sddefault.jpg)';

        // Overlay the Play icon to make it look like a video player
        var play = document.createElement("div");
        play.setAttribute("class", "play");
        videos[i].appendChild(play);

        videos[i].onclick = function () {
            // Create an iFrame with autoplay set to true
            var iframe = document.createElement("iframe");
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if (this.getAttribute("data-params")) iframe_url += '&' + this.getAttribute("data-params");
            iframe.setAttribute("src", iframe_url);
            iframe.setAttribute("frameborder", '0');

            // The height and width of the iFrame should be the same as parent
            iframe.style.width = this.style.width;
            iframe.style.height = this.style.height;

            // Replace the YouTube thumbnail with YouTube Player
            this.parentNode.replaceChild(iframe, this);
        }
    }
});

//menu princial
(function ($) {
    $(function () {
        var scroll = $(document).scrollTop();
        var headerHeight = $('#menu-fixed').outerHeight();

        $(window).scroll(function () {
            var scrolled = $(document).scrollTop();

            if (scrolled > headerHeight) {
                $('#menu-fixed').addClass('off-canvas');
            } else {
                $('#menu-fixed').removeClass('off-canvas');
            }

            if (scrolled > scroll) {
                $('#top-menu').addClass('off-canvas');
                $('#menu-fixed').removeClass('fixed');
            } else {

                if (scrolled <= 112)
                    $('#top-menu').removeClass('off-canvas');

                $('#menu-fixed').addClass('fixed');
            }

            scroll = $(document).scrollTop();
        });

    });
})(jQuery);

//menu blog
(function ($) {
    $(function () {
        var scroll = $(document).scrollTop();
        var headerHeight = $('#menu-blog-fixed').outerHeight();

        $(window).scroll(function () {
            var scrolled = $(document).scrollTop();

            if (scrolled > headerHeight) {
                $('#menu-blog-fixed').addClass('off-canvas');
            } else {
                $('#menu-blog-fixed').removeClass('off-canvas');
            }

            if (scrolled > scroll) {
                $('#top-blog-menu').addClass('off-canvas');
                $('#menu-blog-fixed').removeClass('fixed');
            } else {

                if (scrolled <= 180)
                    $('#top-blog-menu').removeClass('off-canvas');

                $('#menu-blog-fixed').addClass('fixed');
            }

            scroll = $(document).scrollTop();
        });

    });
})(jQuery);