$(document).ready(function () {
    $('#logout_btn').on('click', function (e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    })
});
