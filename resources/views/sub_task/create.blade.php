@php
    $position = \App\Models\Dropdown::where('category_id', 3)->orderBy('name')->get();
@endphp

<form method="POST" action="{{ route('sub_task') }}">
    @csrf
    @isset($data)
        @method('put')
        <input type="hidden" name="id" value="{{ $data->id }}">
    @endisset

    <div class="px-4 row">
        <div class="mb-3 col-12">

        </div>
        <div class="mb-3 col-12">
            <x-input-text
                type="text"
                name="name"
                label="Name"
                value="{{ isset($data) ? $data->name : '' }}"
                required="true"
            />
        </div>
         <div class="mb-3 col-12">
            <x-input-text
                type="textarea"
                name="description"
                label="Description"
                value="{{ isset($data) ? $data->description : '' }}"

            />
        </div>

         <div class="mb-3 col-6">
             <x-input-select
                 :options="['Pending','In-Progress', 'Completed']"
                 :selected="isset($data) ? $data->status : 'Pending'"
                 name="status"
                 :values="['Pending','In-Progress', 'Completed']"
                 :type="1"
                 required="true"
                 label="Status"
             />
        </div>

         <div class="mb-3 col-6">
             <x-input-select
                 :options="['High','Medium', 'Low']"
                 :selected="isset($data) ? $data->priority : 'Low'"
                 name="priority"
                 :values="['High','Medium', 'Low']"
                 :type="1"
                 required="true"
                 label="Priority"
             />
        </div>

         <div class="mb-3 col-6">
            <x-input-text
                type="date"
                name="start_date"
                label="Start Date"
                value="{{ isset($data) ? $data->start_date : '' }}"
                required="true"
            />
        </div>

         <div class="mb-3 col-6">
            <x-input-text
                type="date"
                name="due_date"
                label="Due Date"
                value="{{ isset($data) ? $data->due_date : '' }}"
                required="true"
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

