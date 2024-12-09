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
                    <h6 class="card-title mb-0">{{ __('admin.check_ups_list') }}</h6>

                    <a href="{{ route('admin.check-ups.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_check_up') }}
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
                        @foreach($this->checkups as $checkUp)
                            <tr>
                                <td>{{ $checkUp->title }}</td>
                                <td style="text-align: right">
                                    <a href="{{ route('admin.check-ups.edit', $checkUp->slug ?? $checkUp->id) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                    <a wire:click="deleteItem('{{ $checkUp->id }}', 'checkUp')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->checkups->links() }}
        </div>
    </div>
</div>
