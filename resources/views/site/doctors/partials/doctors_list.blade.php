<div class="doctors-list row">
    @forelse($doctors as $doctor)
        <div class="content-item col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="doctors--item">
                <a href="{{ route('doctors.show', ['doctor' => $doctor->slug ?? $doctor->id]) }}" class="inner">
                    <div class="wrap-img mb-3">
                        <img src="{{ $doctor->imageUrl }}" alt="{{ $doctor->title }}">
                    </div>
                    <div class="experience-quantity mb-3">Досвід роботи: {{ $doctor->expirience }} років</div>
                    <div class="h4 mb-1 font-weight-bolder">{{ $doctor->title }}</div>
                    <div class="position-work">{{ $doctor->specialization->title ?? '' }}</div>
                </a>
            </div>
        </div>
    @empty
        <p>{{ __('doctor.no_doctors') }}</p>
    @endforelse
</div>

<nav class="mt-5 mt-lg-3">
    {{-- {{ $doctors->links() }} --}}
</nav>
