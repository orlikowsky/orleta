var setVisited = function () {
    $.cookie('visited', 'yes', {expires: 180});
    $('.modal-content').hide();
}

$(document).ready(function() {
    var cookie = $.cookie('visited');

    if(cookie === undefined) {
        $('.modal-content').show();
    }
});