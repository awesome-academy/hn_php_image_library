<div id="footerc">
    <div id="footer">
        <div id="finfo">
            <a href="/"><img id="logo" src="{{ asset('img/logo.png') }}" width="149" height="36px"></a>
            <p>{{ __('footer_quote') }}</p>
        </div>
        <div id="fpopular">
            <h2>{{ ucfirst(__('tools')) }}</h2>
            <ul>
                @if (Auth::check())
                    <li><a
                            href="{{ route('profile.upload') }}">{{ ucfirst(__('upload', ['name' => __('image')])) }}</a>
                    </li>
                @endif
            </ul>
        </div>
        <div id="fnav">
            <h2>Info</h2>
            <ul>
                <li><a href="#">{{ ucfirst(__('about us')) }}</a></li>
                <li><a href="#">{{ ucfirst(__('contact')) }}</a></li>
            </ul>
        </div>
        <div id="fsocial">
            <h2>{{ ucfirst(__('follow us')) }}</h2>
        </div>
        <div id="rights">
            <p>{{ __('footer_copyright') }}</p>
        </div>
    </div>
</div>
