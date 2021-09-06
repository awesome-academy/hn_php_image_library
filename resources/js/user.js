$(document).ready(function () {

    $('#followprofile').click(function (e) {
        e.preventDefault();
        let _this = $(this);
        $.ajax({
            type: "POST",
            data: {
                'api_token': $('#api_token').val(),
            },
            url: _this.attr('src'),
            success: function (response) {
                if (!response) {
                    _this.removeClass('followprofile');
                    _this.addClass('followedprofile');
                    _this.html('Unfollow');
                } else {
                    _this.removeClass('followedprofile');
                    _this.addClass('followprofile');
                    _this.html('Follow');
                }
            }
        });
    });

})
