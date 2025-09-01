<form method="POST" action="{{ route('dropdown_category') }}">
    @csrf
    @isset($data)
        @method('put')
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endisset

    <div class="px-4 mb-3">
        <x-input-text
            type="text"
            name="name"
            label="Name"
            value="{{ isset($data) ? $data->name : '' }}"
            required="true"
        />
    </div>

    <div class="form-check form-switch mb-4" style="margin-left: 25px;">
        <input class="form-check-input" type="checkbox" role="switch" name="active_flag" value="1" id="active_flag" {{ (isset($data) && $data->active_flag == 1) ? 'checked' : (empty($data) ? 'checked' : '' ) }}>
        <label class="form-check-label" for="active_flag">Enable</label>
    </div>

    {{-- Buttons --}}
    <div class="modal-footer">
        <x-button
            type='button'
            class="btn-danger rounded-pill"
            icon="bi bi-x-lg"
            name="Close"
            data-bs-dismiss="modal"
        />
        <x-button
            type='submit'
            class="btn-success rounded-pill"
            icon="bi bi-save2"
            name="Submit"
        />
    </div>
</form>

