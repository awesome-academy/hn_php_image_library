$(document).ready(function () {

    $('.addtofavorite').on('click', function () {
        let _this = $(this);
        if (_this.hasClass('no-login')) {
            let loginreq = $('.loginreq');
            loginreq.removeClass('hidden');
            loginreq.addClass('block');
            setInterval(function () {
                loginreq.removeClass('block');
                loginreq.addClass('hidden');
            }, 1500);
        } else {
            if (!_this.find('img').hasClass('favorited')) {
                _this.find('img').addClass('favorited');
            } else {
                _this.find('img').removeClass('favorited');
            }
            $.ajax({
                type: "POST",
                data: {
                    'api_token': $('#api_token').val(),
                },
                url: _this.attr('src'),
                success: function (response) {
                    _this.find('p').html(response);
                }
            });
        }
    });
    $('.sharetomylist').on('click', function (e) {
        e.preventDefault()
        let _this = $(this);
        $.ajax({
            type: "POST",
            data: {
                'api_token': $('#api_token').val(),
            },
            url: _this.attr('src'),
            success: function (response) {
                if (response) {
                    _this.html('Add to my favorites')
                } else {
                    _this.html('Unfavorited')
                }
            }
        });
    });

    $('.download').on('click', function () {
        let _this = $(this);
        _this.find('p').html(parseInt(_this.find('p').html()) + 1);
    });

    $('#btncomment').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            data: {
                'api_token': $('#api_token').val(),
                '_token': $('#csrf_token').val(),
                'content': $('#comment_content').val(),
                'image_id': $('#image_id').val(),
            },
            url: $('#comment_api').val(),
            success: function (response) {
                let comment_count = $('#comment_count');
                let count = comment_count.find('span');
                count.html(parseInt(count.html()) + 1);
                comment_count.after(response);
            }
        });
    });

})
