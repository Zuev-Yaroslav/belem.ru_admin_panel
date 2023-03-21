<?php


namespace App\Http\Filters;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserFilter extends AbstractFilter
{
    public const ROLE_ID = 'role_id';
    public const PERMISSION_ID = 'permission_id';
    public const USERNAMESORT = 'userNameSort';
    public const EMAILSORT = 'emailSort';
    public const ROLESORT = 'roleSort';
    public const SEARCH = 'search';

    protected function getCallbacks(): array
    {
        return [
            self::ROLE_ID => [$this, 'role_id'],
            self::PERMISSION_ID => [$this, 'permission_id'],
            self::USERNAMESORT => [$this, 'userNameSort'],
            self::EMAILSORT => [$this, 'emailSort'],
            self::ROLESORT => [$this, 'roleSort'],
            self::SEARCH => [$this, 'search'],
        ];
    }
    public function search(Builder $builder, $value)
    {
        // dump($value);
        $builder->where(function($b) use($value) {
            $b->orwhere('users.name', 'like', "%{$value}%")
            ->orwhere('email', 'like', "%{$value}%");
            // ->orwhere('roles.name', 'like', "%{$value}%");
        });
    }
    public function role_id(Builder $builder, $value)
    {
        // foreach($array as $value) {
            $builder = $builder->wherein('role_id', $value);
        // }
    }
    public function permission_id(Builder $builder, $value)
    {
        $builder->WhereHas('role.permissions', function($b) use ($value) {
            $b->wherein('permission_id', $value)->groupBy('role_id')->having(DB::raw('count(*)'), '=', count($value));
        });
    }
    public function userNameSort(Builder $builder, $value)
    {
        // dump($value);
        $builder->orderBy('name', $value);
    }
    public function emailSort(Builder $builder, $value)
    {
        // dump($value);
        $builder->orderBy('email', $value);
    }
    public function roleSort(Builder $builder, $value)
    {
        // dump($value);
        $builder->orderBy('roles.name', $value);
    }
}