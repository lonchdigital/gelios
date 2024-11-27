<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">Список сторінок блоку інфо</h6>
                </div>

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>Сортування</th>
                                <th>Назва</th>
                                <th>Чи відображати в футері</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->infos as $info)
                                <tr>
                                    <td>
                                        @if ($loop->iteration !== 1)
                                            <div style="cursor: pointer;"
                                                wire:click="newPosition(-1, {{ $info }})">
                                                <i class="fa fa-sort-up"></i>
                                            </div>
                                        @endif
                                        {{ $info->sort }}
                                        @if (!$loop->last)
                                            <div style="cursor: pointer;"
                                                wire:click="newPosition(+1, {{ $info }})">
                                                <i class="fa fa-sort-desc"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $info->page->title }}</td>
                                    <td style="text-align: right">
                                        <div class="new-checkbox art-text-block-switcher">
                                            <label class="switch">
                                                <input type="checkbox" wire:click="changeIsActive({{ $info }})" @if($info->is_active) checked @endif>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">Список сторінок блоку напрямки</h6>
                </div>

                <div class="table-responsive art-cars-list">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>Сортування</th>
                                <th>Назва</th>
                                <th>Чи відображати в футері</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->directions as $info)
                                <tr>
                                    <td>
                                        @if ($loop->iteration !== 1)
                                            <div style="cursor: pointer;"
                                                wire:click="newDirectionPosition(-1, {{ $info }})">
                                                <i class="fa fa-sort-up"></i>
                                            </div>
                                        @endif
                                        {{ $info->sort }}
                                        @if (!$loop->last)
                                            <div style="cursor: pointer;"
                                                wire:click="newDirectionPosition(+1, {{ $info }})">
                                                <i class="fa fa-sort-desc"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $info->page->title }}</td>
                                    <td style="text-align: right">
                                        <div class="new-checkbox art-text-block-switcher">
                                            <label class="switch">
                                                <input type="checkbox" wire:click="changeDirectionIsActive({{ $info }})" @if($info->is_active) checked @endif>
                                                <span class="slider"></span>
                                            </label>
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
