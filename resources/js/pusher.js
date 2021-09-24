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

    checkNotificationCount(notificationsCount);
// Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher($('#MIX_PUSHER_APP_KEY').val(), {
        cluster: $('#MIX_PUSHER_APP_CLUSTER').val(),
        encrypted: true
    });

// Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('image-channel');

// Bind a function to a Event (the full Laravel class)
    channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', (data) => {
        checkNotificationCount($('#notification_count'));
        notificationsCount.html(parseInt(notificationsCount.html()) + 1);
        let image = (data.image === '') ? 'img/no-avatar.png' : data.image;
        notifications.prepend(`<a><div class="nitem unread">
          <a href="/image/` + data.slug + `?read=` + data.id + `">
             <img class="av" src="` + image + `"
                 width="45"><div class="txt"><p><b>` + data.title + `</b></p>
                 <p>` + data.content + `</p></div></a></div></a>`)
    })
})
