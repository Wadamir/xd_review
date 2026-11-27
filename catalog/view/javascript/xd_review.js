(function ($) {
    "use strict";

    $(function () {
        $(".xd-review-swiper").each(function () {
            var $swiper = $(this);

            $swiper.swiper({
                mode: "horizontal",
                slidesPerView: 3,
                spaceBetween: 20,
                autoplay: 5000,
                autoplayDisableOnInteraction: false,
                loop: true,
                nextButton: $swiper.parent().find(".xd-review-swiper-button-next"),
                prevButton: $swiper.parent().find(".xd-review-swiper-button-prev"),
                breakpoints: {
                    767: {
                        slidesPerView: 1
                    },
                    991: {
                        slidesPerView: 2
                    },
                    1199: {
                        slidesPerView: 3
                    }
                }
            });
        });

        $(".xd-review-widget").each(function () {
            var $widget = $(this);

            $widget.on("click", ".xd-review-list .pagination a", function (event) {
                event.preventDefault();

                var $list = $widget.find(".xd-review-list");

                $.ajax({
                    url: this.href,
                    type: "get",
                    dataType: "html",
                    cache: false,
                    success: function (html) {
                        $list.html(html);
                    },
                    error: function () {
                        $widget
                            .find(".xd-review-message")
                            .removeClass("alert-success")
                            .addClass("alert-danger")
                            .text($widget.data("error-request"))
                            .show();
                    }
                });
            });
        });
    });
})(jQuery);

function updateWindowWidth() {
    const widthWithoutScrollbar = document.documentElement.clientWidth;

    document.documentElement.style.setProperty('--window-width', `${widthWithoutScrollbar}px`);
}

window.addEventListener('resize', updateWindowWidth);
document.addEventListener('DOMContentLoaded', updateWindowWidth);
updateWindowWidth();
