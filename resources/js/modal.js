$(document).ready(function () {
    $("#delete_btn").click(function (e) {
        e.preventDefault();
        document.getElementById('id01').style.display = 'block'

    });

    $('.cancelbtn').click(function () {
        document.getElementById('id01').style.display = 'none'
    });

    $('.close').click(function () {
        document.getElementById('id01').style.display = 'none'
    });
});
