<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
    <a href="#" class="mx-auto">
        @php
        $data_sekolah = App\Models\DataSekolah::all()->first();
        @endphp

        @if($data_sekolah == null)
        <img src="{{asset('admin/assets/images/users/logo_default.png')}}" alt="Logo Sekolah" class="h-40px app-sidebar-logo-default theme-light-show">
        <img src="{{asset('admin/assets/images/users/logo_default.png')}}" alt="Logo Sekolah" class="h-30px app-sidebar-logo-minimize">
        @else
        <img src="{{asset('admin/assets/images/users/'.$data_sekolah->logo)}}" alt="Logo Sekolah" class="h-40px app-sidebar-logo-default theme-light-show">
        <img src="{{asset('admin/assets/images/users/'.$data_sekolah->logo)}}" alt="Logo Sekolah" class="h-30px app-sidebar-logo-minimize">
        @endif
    </a>
    <div id="kt_app_sidebar_toggle"
        class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate "
        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
        data-kt-toggle-name="app-sidebar-minimize">
        <span class="menu-icon rotate-180">
            <i class="bi bi-chevron-double-left fs-3"></i>
        </span>
    </div>
</div>
