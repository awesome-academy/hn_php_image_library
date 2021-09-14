function getSearch(page, query) {
    $.ajax({
        type: "GET",
        url: $('#search_api').val() + '?q=' + query + '&page=' + page,
        success: function (response) {
            let suwp = $('#suwp');
            suwp.html(response);
            $('#subheader').find('h1').html('Search for ' + query);
            reload();
        }
    })
}

function reload() {
    $('.pagination a').unbind('click').on('click', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#q').val();
        getSearch(page, query);
    });
}

$(document).ready(function () {
    reload();

    $('#q').on('input', function () {
        getSearch(1, $(this).val());
    });
});



