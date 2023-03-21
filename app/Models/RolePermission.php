<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\RolePermissionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\RolePermission
 *
 * @property int $id
 * @property int|null $role_id
 * @property int|null $permission_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static RolePermissionFactory factory(...$parameters)
 * @method static Builder|RolePermission newModelQuery()
 * @method static Builder|RolePermission newQuery()
 * @method static Builder|RolePermission query()
 * @method static Builder|RolePermission whereCreatedAt($value)
 * @method static Builder|RolePermission whereId($value)
 * @method static Builder|RolePermission wherePermissionId($value)
 * @method static Builder|RolePermission whereRoleId($value)
 * @method static Builder|RolePermission whereUpdatedAt($value)
 * @mixin Eloquent
 */
class RolePermission extends Model
{
    use HasFactory;

    // public function
}
