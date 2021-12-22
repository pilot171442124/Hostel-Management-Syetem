<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manageloginid extends Model
{
    use HasFactory;

    protected $table='manageloginid';
    protected $fillable = [
        'studentid',
        'studentname',
        'studentdept',
        'batch'
    ];



        protected $casts = [
            'email_verified_at' => 'datetime',
        ];



}
