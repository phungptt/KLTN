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
});

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
