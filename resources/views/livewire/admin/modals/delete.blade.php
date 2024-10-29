<div>
    @if ($isOpen)
        <div class="md-modal md-show"
            style="
    display: flex;
    position: fixed;
    top: 50%;
    left: 50%;
    width: 300%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999999999999;
    justify-content: center;
    align-items: center;
    transform: translate(-50%, -50%);
    ">
            <div class="md-content"
                style="background-color: white; padding: 20px; border-radius: 8px; width: 500px; height: 205px; overflow-y: auto;">
                <h3 class="bg-info">{{ $this->modalTitle }}</h3>
                <div>
                    <p>{{ $this->modalBody }}</p>
                    {{-- <ul>
                        <li><strong>Read:</strong> modal windows will probably tell you something important so don't
                            forget
                            to read what they say.</li>
                        <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it
                            and
                            appreciate its presence.</li>
                        <li><strong>Close:</strong> click on the button below to close the modal.</li>
                    </ul> --}}
                    <div class="d-flex justify-content-end mt-3" style="text-align: right">
                        <div>
                        <button class="btn btn-primary md-close m-1" wire:click="closeModal">Cancel</button>
                        </div>
                        <div>
                        <button class="btn btn-danger md-close m-1" wire:click="confirmDelete()">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
