<div class="app-navbar flex-shrink-0 align-items-center">
    @role('admin|dosen')
        <span class="fw-bold">{{ now()->format('l, d M Y') }}</span>
        <div class="bullet bg-secondary h-35px w-1px mx-5"></div>
    @endrole
    <div class="app-navbar-item ms-md-3" id="kt_header_user_menu_toggle">
        <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">
            @role('dosen')
                @if ($guru->photo ?? '')
                    <img src="{{ asset('admin/assets/images/users/guru/' . $guru->photo) }}">
                @else
                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                        {{ substr(auth()->user()->name, 0, 1) }}</div>
                @endif
            @endrole

            @role('admin')
                <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                    {{ substr(auth()->user()->name, 0, 1) }}</div>
            @endrole

            @role('mahasiswa|perpustakaan|pegawai')
                <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                    {{ substr(auth()->user()->name, 0, 1) }}</div>
            @endrole
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
            data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-primary">
                            {{ substr(auth()->user()->name, 0, 1) }}</div>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}</div>
                        <a href="#"
                            class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                @role('admin')
                    <a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#profil">
                        Edit Profile
                    </a>
                    <a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#pengaturan">
                        Pengaturan
                    </a>
                @endrole
                @role('perpustakaan')
                    <a href="{{ route('perpustakaan.pengaturan.index') }}" class="menu-link px-5">
                        Pengaturan
                    </a>
                @endrole
                @role('dosen')
                    <a href="{{ route('guru.pengaturan.index') }}" class="menu-link px-5">
                        Edit Profile
                    </a>
                @endrole
                @role('mahasiswa')
                    <a href="{{ route('siswa.pengaturan.index') }}" class="menu-link px-5">
                        Edit Akun
                    </a>
                @endrole
                @role('pegawai')
                <a href="{{ route('pegawai.pengaturan.index') }}" class="menu-link px-5">
                    Edit Akun
                </a>
            @endrole
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#logoutAlert">Logout</a>
            </div>
        </div>
    </div>
</div>
