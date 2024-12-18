<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h6 class="card-title mb-0">{{ __('admin.direactions_blocks_list') }} {{ $surgery->title }}</h6>

                    <a href="{{ route('admin.surgery.create-block', ['surgery' => $surgery]) }}"
                        class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + {{ __('admin.add_block') }}
                    </a>
                </div>

                <table class="table mt-1">
                    <thead>
                        <tr style="background-color: rgba(149, 149, 149, 0.2)">
                            <th>{{ __('admin.image') }}</th>
                            <th>{{ __('admin.text') }}</th>
                            <th style="text-align: right">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($this->surgery->surgeryBlocks as $block)
                            <tr class="hover">
                                <td>
                                    <img src="{{ $block->imageUrl }}" width="60">
                                </td>
                                <td>
                                    {{ $block->description }}
                                </td>
                                <td>
                                    <div style="text-align: right">
                                        <a role="button"
                                            href="{{ route('admin.surgery.edit-direction-block', ['surgery' => $surgery, 'block' => $block]) }}"
                                            class="btn btn-accent btn-xs">
                                            <i class="fa fa-edit text-info font-18"></i>
                                        </a>
                                        <a wire:click="deleteItem('{{ $block->id }}', 'surgeryBlock')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        {{-- <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{ $this->doctors->links() }}
        </div> --}}
    </div>
</div>
