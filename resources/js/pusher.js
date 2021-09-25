function checkNotificationCount(notificationsCount) {
    let count = notificationsCount.data('count');
    if (count <= 0) {
        notificationsCount.addClass('hidden');
    } else {
        notificationsCount.removeClass('hidden')
    }
}

$(document).ready(() => {
    var notificationsCount = $('#notification_count');
    var notifications = $('#nboxc');
    let id = $('#user_id').val();
    checkNotificationCount(notificationsCount);
    Pusher.logToConsole = true;

    Echo.private(`users.${id}`)
        .notification((data) => {
            notificationsCount.data('count', notificationsCount.data('count') + 1);
            notificationsCount.html(parseInt(notificationsCount.html()) + 1);
            checkNotificationCount($('#notification_count'));
            let image = (data.image === '') ? 'img/no-avatar.png' : data.image;
            notifications.prepend(`<a><div class="nitem unread">
          <a href="/image/` + data.slug + `?read=` + data.id + `">
             <img class="av" src="` + `/` + image + `"
                 width="45"><div class="txt"><p><b>` + data.title + `</b></p>
                 <p>` + data.content + `</p></div></a></div></a>`)
        })
})
