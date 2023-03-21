@php
    $i = 1;
@endphp
@foreach ($users as $user)
<tr>
    <th scope="row">{{ $i }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role->name }}</td>
    <td>
        <button class="btn btn-info" data-toggle="collapse" data-target="#RolePermissionsShow{{ $user->id }}">Показать права</button>
        <div id="RolePermissionsShow{{ $user->id }}" class="collapse mt-3">
            @if (count($user->role->permissions) > 0)
            @foreach ($user->role->permissions as $permission)
            <p>{{ $permission->permission_name }}</p>
            @endforeach
            @else
            <p>Нет прав</p>
            @endif
        </div>
    </td>
</tr>
@php
$i++;
@endphp
@endforeach