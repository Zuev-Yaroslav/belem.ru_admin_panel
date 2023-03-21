@php
/** @var \App\Models\User $users */
/** @var \App\Models\User $user */
// $i = 1;
@endphp
@extends('layouts.admin')
@section('title')
| Пользователи
@endsection
@section('nav_users')
menu-open
@endsection
@section('users')
active
@endsection
@section('users_list')
active
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пользователи</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div id="container-fluid" class="container-fluid">
            <div style="overflow-x: auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                @if((isset($_GET['userNameSort'])) && $_GET['userNameSort'] === 'desc')
                                <span id="sortUserName" style="cursor: pointer;" data-url="{{ route('admin.user.index') }}" data-page="@if(isset($_GET['page'])) {{ $_GET['page'] }}@else 1 @endif" data-sort="asc">
                                    Имя пользователя
                                    <i class="fa-solid fa-arrow-up-a-z"></i>
                                @else
                                <span id="sortUserName" style="cursor: pointer;" data-url="{{ route('admin.user.index') }}" data-page="@if(isset($_GET['page'])) {{ $_GET['page'] }}@else 1 @endif" data-sort="desc">
                                    Имя пользователя
                                    <i class="fa-solid fa-arrow-down-a-z"></i>
                                @endif
                            </th>
                            <th scope="col">
                                @if((isset($_GET['emailSort'])) && $_GET['emailSort'] === 'desc')
                                <span id="sortEmail" style="cursor: pointer;" data-url="{{ route('admin.user.index') }}" data-page="@if(isset($_GET['page'])) {{ $_GET['page'] }}@else 1 @endif" data-sort="asc">
                                    E-mail
                                    <i class="fa-solid fa-arrow-up-a-z"></i>
                                
                                @else
                                <span id="sortEmail" style="cursor: pointer;" data-url="{{ route('admin.user.index') }}" data-page="@if(isset($_GET['page'])) {{ $_GET['page'] }}@else 1 @endif" data-sort="desc">
                                    E-mail
                                    <i class="fa-solid fa-arrow-down-a-z"></i>
                                    
                                @endif</th>
                            <th scope="col">
                                @if((isset($_GET['roleSort'])) && $_GET['roleSort'] === 'desc')
                                <span id="sortRole" style="cursor: pointer;" data-url="{{ route('admin.user.index') }}" data-page="@if(isset($_GET['page'])) {{ $_GET['page'] }}@else 1 @endif" data-sort="asc">
                                    Роль
                                    <i class="fa-solid fa-arrow-up-a-z"></i>
                                
                                @else
                                <span id="sortRole" style="cursor: pointer;" data-url="{{ route('admin.user.index') }}" data-page="@if(isset($_GET['page'])) {{ $_GET['page'] }}@else 1 @endif" data-sort="desc">
                                    Роль
                                    <i class="fa-solid fa-arrow-down-a-z"></i>
                                    
                                @endif
                            </th>
                            </th>
                            <th></th>
                            <div id="hidden_filter">
                                @isset($_GET['role_id'])
                                    @foreach ($_GET['role_id'] as $id)
                                        <input form="search" class="roles" name="role_id[]" type="hidden" value="{{ $id }}">
                                    @endforeach
                                @endisset
                                @isset($_GET['permission_id'])
                                    @foreach ($_GET['permission_id'] as $id)
                                        <input class="perms" form="search" name="permission_id[]" type="hidden" value="{{ $id }}">
                                    @endforeach
                                @endisset
                            </div>
                            <div id="div_hidden_search">
                                @isset($_GET['search'])
                                    <input id="hidden_search" form="filter" name="search" type="hidden" value="{{ $_GET['search'] }}">
                                @endisset
                            </div>
                        </tr>
                    </thead>
                    <tbody id="list">
                        @include('includes.admin.user.list')
                    </tbody>
                </table>
            </div>
            @include('includes.admin.user.pagination')
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('filter')
<div class="mt-4">
    <!-- <h6>Роли</h6> -->
    <form id="filter" method="get" action="{{ route('admin.user.index') }}">
        <div class="form-group">
            <label>Роли</label>
            <select class="select2" name="role_id[]" multiple="multiple" data-placeholder="Выберите роль" style="width: 100%;">
                @foreach ($roles as $role)
                    <option 
                    @if(isset($_GET['role_id']))
                        @foreach ($_GET['role_id'] as $role_id)
                            @if($role_id == $role->id)
                                selected
                            @endif
                        @endforeach
                    @endif
                    value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Права</label>
            <select class="select2" name="permission_id[]" multiple="multiple" data-placeholder="Выберите права" style="width: 100%;">
                @foreach ($permissions as $perm)
                    <option 
                    @if(isset($_GET['permission_id']))
                        @foreach ($_GET['permission_id'] as $permission_id)
                            @if($permission_id == $perm->id)
                                selected
                            @endif
                        @endforeach
                    @endif
                    value="{{ $perm->id }}">{{ $perm->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Фильтровать</button>
    </form>
</div>
@endsection
@section('scripts')
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script>
    $(function() {
        $('.select2').select2()
    })
</script>
@endsection