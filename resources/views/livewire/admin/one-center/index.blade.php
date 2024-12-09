<div class="row">
    <div class="col-12">
        <div class=" mb-30">
            <div class=" pb-0">

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-30">
                            <div class="card-body pb-0">

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center mb-20">
                                    <h6 class="card-title mb-0">{{ trans('admin.all_centers') }}</h6>

                                    <a href="{{ route('one.center.create') }}"
                                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                                        + {{ trans('admin.add') }}
                                    </a>
                                </div>

                                <div class="table-responsive art-cars-list">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.name') }}</th>
                                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pages as $page)
                                            <tr>
                                                <td>{{ $page->title }}</td>
                                                <td style="text-align: right">
                                                    <a href="{{ route('one.center.edit', $page) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>

                                                    <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $page->id }}">
                                                        <i class="fa fa-trash text-danger font-18"></i>
                                                    </a>
                                                    <div class="md-modal md-effect-1" id="modal-{{ $page->id }}">
                                                        <div class="md-content">
                                                            <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                            <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $page->title }}"?</p>
                                                            <div class="d-flex art-modal-buttons">
                                                                <a href="#" class="btn btn-primary md-close" style="color:#fff">{{ trans('admin.close') }}</a>
                                                                <button wire:click="removeOneCenterFromDB('{{ $page->id }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
