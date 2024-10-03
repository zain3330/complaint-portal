<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role(){
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function hasPermissionToRoute($route)
    {
        // Check if the user has an admin role
        if ($this->role_id == 1) {
            return true;
        }
// Check if the user has a role and permissions
        if ($this->role && $this->role->permissions) {
            foreach ($this->role->permissions as $permission) {
                if ($permission->routes->contains('route', $route)) {
                    return true;
                }
            }
        }

        // Log that the user does not have permission
        Log::info('User ID ' . $this->id . ' does not have permission for route: ' . $route);

        return false;
    }

}
