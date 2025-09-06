<form method="POST" action="{{ route('destroy_task') }}">
    @csrf

    <h5>Deleted Task is Irreversible.</h5>
    <p>Do you want to Continue?</p>
    <input type="hidden" name="id" value="{{ $data->id }}">

    {{-- Buttons --}}
    <div class="modal-footer">
        <x-button
            type='button'
            class="btn-danger rounded-pill"
            icon="bi bi-x-lg"
            name="No"
            data-bs-dismiss="modal"
        />
        <x-button
            type='submit'
            class="btn-success rounded-pill"
            icon="bi bi-save2"
            name="Yes"
        />
    </div>
</form>


