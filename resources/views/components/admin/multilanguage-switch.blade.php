 <ul id="lang-fields-witcher" class="nav nav-pills nav-fill">
    @foreach(config('app.available_languages') as $availableLanguage)
        <li class="nav-item d-flex flex-grow-0">
            <a class="lang-{{ $availableLanguage }} multilang-switch nav-link py-1 px-2 @if($availableLanguage == config('app.active_lang'))active @endif" href="#{{ $availableLanguage }}">{{ mb_strtoupper($availableLanguage) }}</a>
            {{-- <a class="lang-{{ $availableLanguage }} multilang-switch nav-link py-1 px-2 @if($availableLanguage == app()->getLocale())active @endif" href="#{{ $availableLanguage }}">{{ mb_strtoupper($availableLanguage) }}</a> --}}
        </li>
    @endforeach
</ul>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.multilang-switch').click(function (event) {
                event.preventDefault();

                const languageCode = $(this).attr('href').substring(1);

                $('.multilang-switch').removeClass('active');
                $(this).addClass('active');
                $('.multilang-content').removeClass('active').removeClass('show').each(function () {
                    if ($(this).attr('language') === languageCode) {
                        $(this).addClass('active').addClass('show');
                    }
                });

                // Livewire.dispatch('languageSwitched', { lang: languageCode });
            });
        });
    </script>
@endpush
