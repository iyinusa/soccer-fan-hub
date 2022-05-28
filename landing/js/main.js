/**
 * $.browser.mobile (http://detectmobilebrowser.com/)
 *
 * $.browser.mobile will be true if the browser is a mobile device
 *
 **/
(function (a) {
    (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
})(navigator.userAgent || navigator.vendor || window.opera);

var myApplication = function () {

    var linkLocation;

    var accordionPanels = $(".accordion > dd").hide();

    var toggleTable = $(".pricing-table-togglable .plan-features").hide();

    function redirectPage() {
        window.location = linkLocation;
    }

    // sticky header
    function stickyHeader() {
        var yoffset = $(window).scrollTop(),
            headerheight = $(window).height();
        if (yoffset >= headerheight) {
            if (!$(".header").hasClass("sticky") && !$(".header").hasClass("fixed-sticky")) {
                $(".header").addClass("sticky").stop().animate({
                    top: 0
                });
            }
        } else {
            if ($(".header").hasClass("sticky")) {
                $('.header').fadeOut().promise().done(function () {
                    $(this).removeClass("sticky").removeAttr('style');
                });
            }
        }
    }

    function heroParallax() {
        var scroll = $(window).scrollTop(),
            newscroll = scroll / 2 + "px";

        if (!$.browser.mobile) {
            $(".home .hero-container, .404 .hero-container").css("transform", "translateY(" + newscroll + ")");
        }
    }

    function bindEvents() {
        // fade out loading spinner on load
        $(window).on("load", function () {
            $(".pageload").fadeOut("slow");
        });

        $(window).on("scroll", stickyHeader);

        //hero container parallax effect
        $(window).on("scroll", heroParallax);

        //hero container parallax effect
        $(window).on("resize", initAdjustHeaderHeight);
    }

    function initMobileMenu() {
        $(document).on("click", ".mobile-toggle", function () {
            $(".navigation").slideToggle("middle");
            $("body > .header").toggleClass("open");
        });

        $(document).on("click", ".navigation > .nav > li > a", function () {
            if ($(window).width() < 767 && !$(this).data("toggle")) {
                $(".navigation").slideToggle("2000");
                $("body > .header").toggleClass("open");
            }
        });
    }

    function initLinkTransition() {
        $(document).on("click", "a.transition", function (e) {
            e.preventDefault();
            linkLocation = this.href;
            $("body").fadeOut(1000, "easeInOutExpo", redirectPage);
            return;
        });
    }

    function initOnePageNav() {
        if ($.isFunction($.fn.onePageNav)) {
            // Initialize one page scoll
            $(".spy").onePageNav({
                currentClass: "active",
                changeHash: false,
                scrollSpeed: 1000,
                scrollThreshold: 0.1,
                filter: ":not(.ignore)",
                easing: "easeInOutExpo"
            });
        }
    }

    function initFitVids() {
        if ($.isFunction($.fn.fitVids)) {
            $(".fluid-video").fitVids();
        }
    }

    function initTextRotator() {
        if ($.isFunction($.fn.textrotator)) {
            $(".rotate-text").each(function () {
                var elm = $(this),
                    animation = elm.data("animation-method") || "fade",
                    speed = elm.data("speed") || 1000;
                $(this).find(".rotate").textrotator({
                    animation: animation,
                    speed: speed
                });
            });
        }
    }

    function initParallax() {
        if (!$.browser.mobile) {
            if ($.fn.parallax) {

                $('.parallax').each(function () {
                    $(this).parallax('50%', 0.2);
                });

                $('.parallax-0').each(function () {
                    $(this).parallax('50%', 0);
                });
            }
        }
    }

    function initAccordion() {
        /** Accordion **/
        $(".accordion > dd").first().show();
        $(".accordion > dt > a").first().addClass("active");

        $(document).on("click", ".accordion > dt > a", function (e) {
            e.preventDefault();

            $(this).closest(".accordion").find("dd").slideUp(800, "easeInOutExpo");

            $(this).closest(".accordion").find("a").removeClass("active");

            if ($(this).parent().next().css("display") != "block") {
                $(this).parent().next().slideDown();
                $(this).addClass("active");
                return false;
            }

            return false;

        });
    }

    function initAnimationAPI() {
        if (!$.browser.mobile && $.fn.appear) {
            //run animation when in viewport
            $("[data-animation]").appear();
            $("[data-animation]").on("appear", function () {
                var elm = $(this),
                    animation = elm.data("animation") || "fadeIn",
                    delay = elm.data("delay") || 0;

                if (!elm.hasClass("done")) {
                    setTimeout(function () {
                        elm.addClass("animated " + animation + " done");
                    }, delay);
                }
            });
        } else {
            $("[data-animation]").each(function () {
                var elm = $(this),
                    animation = elm.data("animation") || "fadeIn";

                if (!elm.hasClass("done")) {
                    elm.addClass("animated " + animation + " done");
                }
            });
        }
    }

    function initAnimateNumbers() {
        if (!$.browser.mobile && $.fn.appear) {
            /* count up when in viewport */
            $(".count").appear();
            $(".count").on("appear", function () {
                if (!$(this).hasClass("done")) {
                    $(this).addClass("done").countTo({
                        speed: 1000,
                        refreshInterval: 100
                    });
                }
            });
        } else {
            $(".count").each(function () {
                if (!$(this).hasClass("done")) {
                    $(this).addClass("done").countTo({
                        speed: 1000
                    });
                }
            });
        }
    }

    function initAnimateProgressBars() {
        if (!$.browser.mobile && $.fn.appear) {
            /* animate width when in viewport */
            $(".progress-bar").appear();
            $(".progress-bar").on("appear", function () {


                var elm = $(this),
                    percent = elm.data("percent");

                if (!elm.hasClass("done")) {
                    elm.addClass("done").css("width", Math.ceil(percent) + "%").find(".progress-value").text(Math.ceil(percent) + "%");
                }
            });
        } else {
            $(".progress-bar").each(function () {
                var elm = $(this),
                    percent = elm.data("percent");

                if (!elm.hasClass("done")) {
                    elm.addClass("done").css("width", Math.ceil(percent) + "%").find(".progress-value").text(Math.ceil(percent) + "%");
                }
            });

        }
    }

    function initSmoothScroll() {
        // Smooth scroll to id
        $(document).on("click", ".smooth-scroll", function () {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
                if (target.length) {
                    $("html,body").stop().animate({
                        scrollTop: target.offset().top
                    }, 1000, "easeInOutExpo");
                    return false;
                }
            }
        });
    }

    function initAdjustHeaderHeight() {
        var winheight = $(window).height();

        if ($(".header").hasClass("fixed-sticky")) {
            winheight = Math.floor($(window).height() - $(".header").innerHeight());
        }

        $(".home .hero .container, .404 .hero .container").css("height", (winheight + "px"));
    }

    function initCopyrightYear() {
        $(".year").html((new Date().getFullYear()));
    }

    return {
        init: function () {
            bindEvents();
            initMobileMenu();
            initLinkTransition();
            initOnePageNav();
            initFitVids();
            initTextRotator();
            initParallax();
            initAccordion();
            initAnimationAPI();
            initAnimateNumbers();
            initAnimateProgressBars();
            initSmoothScroll();
            initAdjustHeaderHeight();
            initCopyrightYear();
        }
    };
}();

! function ($) {
    "use strict";
    $(".home .hero-container, .404 .hero-container").css("transform", "translateY(0)");
    myApplication.init();
}(window.jQuery);