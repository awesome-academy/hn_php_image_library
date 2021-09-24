$(document).ready(() => {
    $('#logout_btn').click((e) => {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    })

    $("li#notifications > a").click(() => {
        $("#nbox").toggleClass('hidden');
    });

    $(document).click((e) => {
        if (!$('#notifications').find(e.target).length) {
            $("#nbox").addClass('hidden');
        }
    });

});

