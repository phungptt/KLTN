$(function () {
    $('.navbar-nav .nav-item a').each(function () {
        if ($(this).prop('href') == window.location.href) {
            if ($(this).hasClass('navbar-nav-link')) {
                $(this).addClass('active');
            } else {
                $(this).parent().siblings('.navbar-nav-link').addClass('active');
            }
        }
    });

    $('.navbar-nav .nav-item a.navbar-nav-link').each(function () {
        if ($(this).prop('href') == window.location.href) {
            $(this).addClass('active');
        }
    });

    new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    responsiveMenu();
    headerFixed();
});

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
}; // is Mobile

function fixImageActionsHeight() {
    var cardImgActions = $('.card-img-actions');
    cardImgActions.height(cardImgActions.width() * 5 / 4);
}

$(window).on('resize', function () {
    fixImageActionsHeight();
});

function formatTime(time) {
    var created_at = new Date(time);
    var formatted_date = formatStringDateTime(created_at.getHours()) +
        ":" + formatStringDateTime(created_at.getMinutes()) +
        ":" + formatStringDateTime(created_at.getSeconds()) +
        " " + formatStringDateTime(created_at.getDate()) +
        "-" + formatStringDateTime((created_at.getMonth() + 1)) +
        "-" + formatStringDateTime(created_at.getFullYear());
    return formatted_date;
};

function formatStringDateTime(string) {
    if (string.toString().length === 1) {
        return '0' + string;
    }
    return string;
}

function timeSince(timeStr) {
    var date = new Date(timeStr),
        timediff = Math.floor((new Date() - date) / 1000),
        timestring,
        remain;

    var days = Math.floor(timediff / 86400);
    remain = timediff % 86400;

    var hours = Math.floor(remain / 3600);

    remain = Math.floor(remain % 3600);
    var mins = Math.floor(remain / 60);
    var secs = Math.floor(remain % 60);

    if (secs >= 0) timestring = secs + " seconds ago";
    if (mins > 0) timestring = mins + " mins ago";
    if (hours > 0) timestring = hours + " hours ago";
    if (days > 0) timestring = days + " days ago";

    return timestring;
}

Vue.use(Toasted, Option);

function toastMessage(type, message) {
    Vue.toasted.show(message, {
        type: type,
        theme: "bubble",
        position: "top-center",
        duration: 4000
    });
};

function substringMatcher(words) {
    return function (q, cb) {
        var matches, substrRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
        $.each(words, function (i, word) {
            if (substrRegex.test(word)) {
                matches.push(word);
            }
        });
        cb(matches);
    };
};

function reverseDate(date) {
    var reverse = date.split("-").reverse().join("/");
    return reverse;
}

var responsiveMenu = function() {
    var menuType = 'desktop';

    $(window).on('load resize', function() {
        var currMenuType = 'desktop';

        if (matchMedia('(max-width: 991px)').matches) {
            currMenuType = 'mobile';
        }

        if (currMenuType !== menuType) {
            menuType = currMenuType;
            console.log(menuType,currMenuType )
            if (currMenuType === 'mobile') {
                var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
                var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');

                $('.header').after($mobileMenu);
                hasChildMenu.children('ul').hide();
                hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
                $('.btn-menu').removeClass('active');
            } else {
                var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');

                $desktopMenu.find('.submenu').removeAttr('style');
                $('.header').find('.button-header').before($desktopMenu);
                $('.btn-submenu').remove();
            }
        }
    });

    $('.btn-menu').on('click', function() {
        $('#mainnav-mobi').slideToggle(300);
        $(this).toggleClass('active');
        return false;
    });

    $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
        $(this).toggleClass('active').next('ul').slideToggle(300);
        e.stopImmediatePropagation();
        return false;
    });
}; // Responsive Menu

var headerFixed = function() {
    if ($('body').hasClass('header_sticky')) {
        var nav = $('.header');
        if (nav.length !== 0) {

            var offsetTop = $('.header').offset().top,
                headerHeight = $('.header').height(),
                injectSpace = $('<div />', { height: headerHeight }).insertAfter(nav);
            injectSpace.hide();

            $(window).on('load scroll', function() {
                if ($(window).scrollTop() > offsetTop + 100) {
                    injectSpace.show();
                    $('.header').addClass('downscrolled');

                } else {
                    $('.header').removeClass('downscrolled');
                    injectSpace.hide();
                }

                if ($(window).scrollTop() > 500) {
                    $('.header').addClass('upscrolled');
                } else {
                    $('.header').removeClass('upscrolled');
                }
            })
        }
    }
}; // Header Fixed

// var starRating = Vue.component({
//     props:{
//         value:{type: Number, default: 0},
//         maxStars: {type: Number, default: 5},
//         starredColor: {type: String, default: "#f0dd09"},
//         blankColor: {type: String, default: "darkgray"}
//    },
//    template:"#star-rating-template",
//    methods:{
//         getClass(n){
//              return {
//                   "fa": true,
//                   "fa-star": n <= this.value,
//                   "fa-star-o": n > this.value,
//                   'fa-star-half-o': (this.value / n == 0 && this.value % 2 != 0)
//              }
//         },
//         getStyle(n){
//              return {
//                   color: n <= this.value ? this.starredColor : this.blankColor
//              }
//         }
//    }
// })