@php
    $position = \App\Models\Dropdown::where('category_id', 3)->orderBy('name')->get();
@endphp

<form method="POST" action="{{ route('staff') }}">
    @csrf
    @isset($data)
        @method('put')
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endisset

    <div class="px-4 row">
        <div class="mb-3 col-6">
            <x-input-text
                type="text"
                name="first_name"
                label="First Name"
                value="{{ isset($data) ? $data->first_name : '' }}"
                required="true"
            />
        </div>
        <div class="mb-3 col-6">
            <x-input-text
                type="text"
                name="last_name"
                label="Last Name"
                value="{{ isset($data) ? $data->last_name : '' }}"
                required="true"
            />
        </div>

        <div class="mb-3 col-6">
            <x-input-text
                type="email"
                name="email"
                label="Email"
                value="{{ isset($data) ? $data->email : '' }}"
                required="true"
            />
        </div>

        <div class="mb-3 col-6">
            <x-input-text
                type="date"
                name="date_of_birth"
                label="Date of Birth"
                value="{{ isset($data) ? $data->date_of_birth : '' }}"
                required="true"
            />
        </div>

        <div class="mb-3 col-6">
            <x-input-select
                :options="['Male', 'Female']"
                :selected="isset($data) ? $data->gender : ''"
                name="gender"
                :values="['Male', 'Female']"
                :type="1"
                required="true"
                label="Gender"
            />
        </div>

        <div class="mb-3 col-6">
            <x-input-text
                type="text"
                name="phone"
                label="Phone Number"
                value="{{ isset($data) ? $data->phone : '' }}"
                required="true"
            />
        </div>

        <div class="mb-3 col-6">
            <x-input-text
                type="text"
                name="address"
                label="Address"
                value="{{ isset($data) ? $data->address : '' }}"
                required="true"
            />
        </div>

        <div class="mb-3 col-6">
            <x-input-select
                :options="$position"
                :selected="isset($data) ? $data->position : 0"
                name="position"
                :type="0"
                required="true"
                label="Position"
            />
        </div>
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

