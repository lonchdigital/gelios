<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">Список заявок вакансій</h6>

                    <div>
                        <input type="text" wire:model.live="search" class="form-control">
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>Ім'я</th>
                                <th>Номер телефону</th>
                                <th>Вакансія</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($this->feedbacks as $feedback)
                                @livewire('admin.vacancy-app.one-vacancy', ['feedback' => $feedback], key('feedback' . $feedback->id))
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            <div class="m-2 mt-3">
                {{ $this->feedbacks->links() }}
            </div>
        </div>
    </div>
</div>
