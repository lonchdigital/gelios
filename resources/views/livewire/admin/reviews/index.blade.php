<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">

                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ trans('admin.reviews_list') }}</h5>

                    <a href="{{ route('reviews.create') }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ trans('admin.add_review') }}
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                
                <table class="table mt-1">
                    <thead>
                        <tr style="background-color: rgba(149, 149, 149, 0.2)">
                            <th>ID</th>
                            <th>{{ trans('admin.full_name') }}</th>
                            <th style="text-align: right">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr class="hover">
                                <td>
                                    {{ $review->id }}
                                </td>
                                <td>
                                    {{ $review->name }}
                                </td>
                                <td>
                                    <div style="text-align: right">
                                        <a role="button"
                                            href="{{ route('reviews.edit', ['review' => $review]) }}"
                                            class="btn btn-accent btn-xs">
                                            <i class="fa fa-edit text-info font-18"></i>
                                        </a>

                                        <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $review->id }}">
                                            <i class="fa fa-trash text-danger font-18"></i>
                                        </a>
                                        <div class="md-modal md-effect-1" id="modal-{{ $review->id }}">
                                            <div class="md-content">
                                                <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $review->name }}"?</p>
                                                <div class="d-flex art-modal-buttons">
                                                    <a href="#" class="btn btn-primary md-close">{{ trans('admin.close') }}</a>
                                                    <button wire:click="removeReviewFromDB('{{ $review->id }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
                    {{ $reviews->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>

    </div>
</div>
