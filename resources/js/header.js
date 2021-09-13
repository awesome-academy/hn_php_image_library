$(document).ready(function () {
    $('#logout_btn').click(function (e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    })
});

