@if (session('error'))
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-5">
        <div class="d-flex flex-column text-white pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Error</h4>
            <span>{{ session('error') }}</span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="bi bi-x-lg fs-3 text-light"></i>
        </button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-dismissible bg-primary d-flex flex-column flex-sm-row p-5 mb-5">
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-light">Berhasil</h4>
            <span>{{ session('success') }}</span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="bi bi-x-lg fs-3 text-light"></i>
        </button>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row p-5 mb-5">
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-light">Error</h4>
            <span>{{ $message }}</span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="bi bi-x-lg fs-3 text-light"></i>
        </button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-dismissible bg-info d-flex flex-column flex-sm-row p-5 mb-5">
        <div class="d-flex flex-column text-white pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Info</h4>
            <span>{{ $message }}</span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="bi bi-x-lg fs-3 text-light"></i>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-5">
        <div class="d-flex flex-column text-white pe-0 pe-sm-10">
            <h4 class="mb-2 text-white">Error</h4>
            <span>
                <ul>
                    @foreach ($errors->all() as $val)
                        <li>{{ $val }}</li>
                    @endforeach
                </ul>
            </span>
        </div>

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">
            <i class="bi bi-x-lg fs-3 text-light"></i>
        </button>
    </div>
@endif
