<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userentry extends Model
{
    use HasFactory;

    protected $table='users';
    protected $fillable=['id','name','email','userrole','phone','usercode','activestatus','password'];


}
