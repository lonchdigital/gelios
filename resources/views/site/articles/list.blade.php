<div class="news-list row">
    @forelse($articles as $article)
        <div class="content-item col-12 col-md-6 col-xl-4">
            <div class="news--item">
                <a href="{{ route('articles.show', ['slug' => $article->slug]) }}" class="inner">
                    <div class="wrap-img mb-4">
                        @if ($article->image)
                            <img src="{{ $article->imageUrl }}" alt="{{ $article->title }}">
                        @else
                            <img src="{{ asset('static_images/articles/article-1.jpeg') }}"
                                alt="img">
                        @endif
                        <div class="date-label">{{ Carbon\Carbon::parse($article->created_at)->day }}
                            {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('F') }}
                            {{ Carbon\Carbon::parse($article->created_at)->year }}</div>
                    </div>
                    <div class="h3 small mb-2">{{ $article->title }}</div>
                    <div class="h6 descrp">{!! $article->description !!}</div>
                </a>
            </div>
        </div>
    @empty
    @endforelse
</div>