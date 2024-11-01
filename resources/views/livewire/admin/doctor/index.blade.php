<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">Список лікарів</h6>

                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати лікаря
                    </a>
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
                                <th>Ім'я</th>
                                <th>Зображення</th>
                                <th>Чи відображати на головній сторінці</th>
                                <th style="text-align: right">Дії</th>
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
                                    <a href="{{ route('admin.doctors.edit', ['doctor' => $doctor]) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
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
