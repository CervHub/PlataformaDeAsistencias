<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'lastname', 'url_photo', 'id_company', 'email', 'id_schedule', 'id_user', 'id_role', 'status', 'position'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id');
    }
}
