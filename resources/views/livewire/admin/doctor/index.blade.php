<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">{{ __('admin.doctors_list') }}</h6>

                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <div>
                        <input type="text" wire:model.live="search" class="form-control mb-3" placeholder="пошук">
                        </div>
                        &nbsp;
                        <div>
                            <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                                + {{ __('admin.add_doctor') }}
                            </a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('admin.first_name') }}</th>
                                <th>{{ __('admin.image') }}</th>
                                <th>{{ __('admin.is_show_in_main_page') }}</th>
                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($this->doctors as $doctor)
                            <tr>
                                <td>{{ $doctor->title }}</td>
                                <td>
                                    <img src="{{ $doctor->imageUrl }}" width="60">
                                </td>
                                <td>
                                    <div class="new-checkbox art-text-block-switcher">
                                        <label class="switch mr-3">
                                            <input type="checkbox" wire:click="changeActive('{{ $doctor->id }}')" @if($doctor->is_show_in_main_page) checked @endif>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </td>
                                <td style="text-align: right">
                                    <a href="{{ route('admin.doctors.edit', ['doctor' => $doctor->slug ?? $doctor->id]) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                    <a wire:click="deleteItem('{{ $doctor->id }}', 'doctor')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->doctors->links() }}
        </div>
    </div>
</div>
