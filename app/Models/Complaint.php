<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['name',"email","department","complaint_type","details"];

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
    public function forwardTo()
    {
        return $this->belongsTo(User::class, 'resolver_id');
    }

}
