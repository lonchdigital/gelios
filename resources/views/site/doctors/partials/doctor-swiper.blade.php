<div class="doctors--item swiper-slide">
    <a href="{{ route('doctors.show', ['doctor' => $doctor->slug]) }}" class="inner">
        <div class="wrap-img mb-3">
            <img src="{{ $doctor->imageUrl }}" alt="{{ $doctor->title }}">
        </div>
        @if(!empty($doctor->expirience))
            <div class="experience-quantity mb-3">{{ trans('doctor.work_experience') }}: {{ $doctor->expirience }}</div>
        @endif
        <div class="h4 mb-1 font-weight-bolder">{{ $doctor->title }}</div>
        <div class="position-work">{{ $doctor->specialization->title ?? '' }}</div>
    </a>
</div>
