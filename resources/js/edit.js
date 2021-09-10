$(document).ready(function () {
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
                select.html('');
                select.append(`<option value="0">Subcategory</option>`);
                $.each(response, function (i, value) {
                    select.append(`<option value="` + value.id + `">` + value.name + `</option>`);
                })
            }
        });
    });
})
