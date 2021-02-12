<div wire:ignore.self class="modal fade" id="add-student-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('message.attributes.addStudent') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="first-name">{{ __('message.attributes.name') }}</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first-name"
                               wire:model.lazy="first_name"/>
                        @error('first_name')
                        <div class="text-danger has-error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="last-name">{{ __('message.attributes.lastName') }}</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last-name"
                               wire:model.lazy="last_name"/>
                        @error('last_name')
                        <div class="text-danger has-error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">{{ __('message.attributes.email') }}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.lazy="email"/>
                        @error('email')
                        <div class="text-danger has-error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="phone-number">{{ __('message.attributes.phone') }}</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" id="phone-number"
                               wire:model.lazy="phone_number"/>
                        @error('phone_number')
                        <div class="text-danger has-error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('message.attributes.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('message.attributes.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
