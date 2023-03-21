@extends('layouts.admin')
@section('title')
| Роли
@endsection
@section('nav_users')
menu-open
@endsection
@section('users')
active
@endsection
@section('roles')
active
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Роли</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @php
    $i = 1;
    @endphp
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div style="overflow-x: auto">
                <table class="table">
                    {{-- <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя пользователя</th>
                            <th scope="col">E-Mail</th>
                            <th scope="col">Роль</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $role->name }}</td>
                            <td class="w-25">
                                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#RolePermissionsShow{{ $role->id }}">
                                Права
                                </button>
                                <div id="RolePermissionsShow{{ $role->id }}" class="collapse mt-3">
                                    @if (count($role->permissions) > 0)
                                    @foreach ($role->permissions as $permission)
                                    <p>{{ $permission->permission_name }}</p>
                                    @endforeach
                                    @else
                                    <p>Нет прав</p>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary modal-show" data-modal="#RolePermissionsEdit{{ $role->id }}">
                                    Изменить права
                                </button>
                            </td>
                            <td><button class="btn btn-danger">Удалить</button></td>
                        </tr>
                        <div class="modal fade" id="RolePermissionsEdit{{ $role->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Изменить права</h4>
                                        <button type="button" class="modal-close close" data-modal="#RolePermissionsEdit{{ $role->id }}" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="editRole" action="{{ route('admin.role.update', $role->id) }}" method="POST">
                                        <div class="modal-body">
                                            <div>
                                                <label class="form-label">Права</label>
                                            </div>
                                            @csrf
                                            @method('patch')
                                            @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permision{{ $role->id }}{{ $permission->id }}"
                                                @foreach ($role->permissions as $roleperm)
                                                    @if($permission->id === $roleperm->id)
                                                        checked
                                                    @endif
                                                @endforeach>

                                                <label class="form-check-label" for="permision{{ $role->id }}{{ $permission->id }}">
                                                    {{ $permission->permission_name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-success" type="submit">Изменить</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                </table>
            </div>
            <div class="mt-4 pb-1 justify-content-center d-flex">
                {{ $roles->links('pagination::bootstrap-4') }}
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection
