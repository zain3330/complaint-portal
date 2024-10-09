<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role');
    }
    public function role(){
        return $this->belongsTo(Role::class,'id','role_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
