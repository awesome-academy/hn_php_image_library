$(document).ready(function () {

    $('#addimgbtn').click(function () {
        $('#filepload').trigger('click');
    });

    document.getElementById("filepload").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("uploadimg").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
        $('#dropzone').removeClass('hidden');
        $('#done_btn').removeClass('hidden');
    };

    $('#dz_remove').click(function () {
        $('#dropzone').addClass('hidden');
        $('#done_btn').addClass('hidden');
        $('#extradata').find('input').val('');
        $('#filepload').val(null);
    })

    $('#category_select').change(function () {
        let _this = $(this);

        $.ajax({
            type: "POST",
            data: {
                'id': _this.val(),
            },
            url: $('#api_subcategory').val(),
            success: function (response) {
                let select = $('#subcategory_select');
                select.removeClass('hidden');
                select.html('');
                select.append(`<option value="0">Subcategory</option>`);
                $.each(response, function (i, value) {
                    select.append(`<option value="` + value.id + `">` + value.name + `</option>`);
                })
            }
        });
    });

});
