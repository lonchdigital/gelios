<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ trans('admin.offices') }}</h5>
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
                            <th>{{ trans('admin.address') }}</th>
                            <th style="text-align: right">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr class="hover">
                                <td>
                                    {{ $contact->id }}
                                </td>
                                <td>
                                    {{ $contact->city .' '. $contact->street }}
                                </td>
                                <td>
                                    <div style="text-align: right">
                                        <a role="button"
                                            href="{{ route('offices.edit', ['contact' => $contact]) }}"
                                            class="btn btn-accent btn-xs">
                                            <i class="fa fa-edit text-info font-18"></i>
                                        </a>

                                        <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $contact->id }}">
                                            <i class="fa fa-trash text-danger font-18"></i>
                                        </a>
                                        <div class="md-modal md-effect-1" id="modal-{{ $contact->id }}">
                                            <div class="md-content">
                                                <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $contact->city .' '. $contact->street }}"?</p>
                                                <div class="d-flex art-modal-buttons">
                                                    <a href="#" class="btn btn-primary md-close">{{ trans('admin.close') }}</a>
                                                    <button wire:click="removeContactFromDB('{{ $contact->id }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
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
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0"></h6>

                    <a href="{{ route('offices.create') }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ trans('admin.add_office') }}
                    </a>
                </div>





            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script src="{{ asset('admin_src/js/default-assets/quill-init.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('livewire:load', () => {
            initQuillEditors((quill, fieldName, language) => {
                quill.on('text-change', function () {
                    let value = quill.root.innerHTML;
                    @this.set(`${fieldName}.${language}`, value);
                });
            });
        });
    </script>
@endpush