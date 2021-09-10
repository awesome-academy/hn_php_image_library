<div>
    <p>{{ $comment['content'] }}</p>
    <p class="meta">
        <a href="{{ route('home.user', ['id' => $comment['user']['id']]) }}">
            <img class="avatar-inline" src="{{ asset($comment['user']['avatar']) }}"
                onerror="this.src= '{{ asset('img/no-avatar.png') }}'" width="22"
                height="22">&nbsp;{{ $comment['user_name'] }}
        </a>,&nbsp;{{ date('h:m d/m/Y', strtotime($comment['created_at'])) }}
    </p>
</div>
