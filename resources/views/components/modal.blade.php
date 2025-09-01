{{--sizes: modal-sm, modal-lg, modal-xl, modal-fullscreen--}}
<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

        </div>
    </div>
</div>

<script>
    const exampleModal = document.getElementById('createModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget

            // Ajax Request
            const url = button.getAttribute('data-bs-url')
            $.get(`/modal/${url}`, function(result) {
                $(".modal-body").html(result);
            })

            // Set Modal title
            const title = button.getAttribute('data-bs-title')
            const modalTitle = exampleModal.querySelector('.modal-title')
            modalTitle.textContent = `${title}`

            // Set Modal Size
            const size = button.getAttribute('data-bs-size') //modal-xl, modal-lg
            const setSize = exampleModal.querySelector(".modal-dialog");
            setSize.setAttribute("class", `modal-dialog modal-dialog-centered modal-dialog-scrollable ${size}`);
        })
    }
</script>

<link href="{{ asset("vendor/flasher/flasher.min.css") }}" rel="stylesheet">
<script src="{{ asset("vendor/flasher/flasher.min.js") }}"></script>
