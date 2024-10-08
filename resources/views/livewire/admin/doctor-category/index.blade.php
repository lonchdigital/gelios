<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">Список категорій лікарів</h6>

                    <a href="{{ route('admin.doctor-categories.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати категорію
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
                                <th>Назва</th>
                                <th style="text-align: right">Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($this->categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td style="text-align: right">
                                    <a href="{{ route('admin.article-categories.edit', $category) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->categories->links() }}
        </div>
    </div>
</div>
