<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'pin',
        'role',
    ];

    public function presences_total()
    {
        return $this->hasMany(Presence::class, 'employee_id', 'id');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'employee_id', 'id');
    }

    public function sicks()
    {
        return $this->hasMany(Approval::class, 'employee_id', 'id')->where('type', 'sick_leave');
    }

    public function paid_leaves()
    {
        return $this->hasMany(Approval::class, 'employee_id', 'id')->where('type', 'paid_leave');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class, 'employee_id', 'id')->where('type', 'presence');
    }

    public function aways()
    {
        return $this->hasMany(Presence::class, 'employee_id', 'id')->where('type', 'away');
    }
}
