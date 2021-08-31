$(document).ready(function () {

    $('#avatarfile').click(function () {
        $('#filepload').trigger('click');
    });

    document.getElementById("filepload").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("avatarimg").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };

})
