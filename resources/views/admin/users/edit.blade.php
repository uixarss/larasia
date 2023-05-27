@extends('layouts.joliadmin')

@section('content')

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="{{ route('admin.halamanutama.index') }}">Halaman Utama</a></li>
  <li><a href="{{ route('admin.users.index') }}">Data Akun User</a></li>
  <li class="active">Edit Akun User</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
  <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Akun User</h2>
</div>
<!-- END PAGE TITLE -->

<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">


      <div class="panel panel-default">

        <div class="panel-heading ui-draggable-handle">
          <h3 class="panel-title">Edit Akun {{$user->name}}</h3>
          <ul class="panel-controls">
            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span> Refresh</a></li>
              </ul>
            </li>
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
          </ul>
        </div>
        @include('layouts.alert')
        <div class="panel-body">

          <form action="{{route('admin.users.update', $user)}}" method="POST">

            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">Nama</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            @csrf
            {{method_field('PUT')}}

            <div class="form-group row">
              <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
              @foreach($roles as $role)
              <div class="col-md-2">

                <div class="form-check">
                  <input type="checkbox" name="roles[]" value="{{$role->name}}" @if($user->hasAnyRole($role->name)) checked @endif>
                  <label> {{$role->name}}</label>
                </div>

              </div>
              @endforeach
            </div>

            <div class="form-group row">
              <label for="permissions" class="col-md-2 col-form-label text-md-right">Permissions</label>
              @foreach($permissions as $permission)

              <div class="col-md-2">
                <div class="form-check">
                  <input type="checkbox" name="permissions[]" value="{{$permission->name}}" @if($user->hasPermissionTo($permission->name)) checked @endif>
                  <label> {{$permission->name}}</label>
                </div>
              </div>


              @endforeach
            </div>

        </div>

        <div class="panel-footer">
          <button type="submit" class="btn btn-info pull-right">
            Update Data Akun
          </button>
        </div>


        </form>



      </div>

    </div>
  </div>
</div>


@endsection