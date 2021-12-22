<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $table='salary';
    protected $fillable=['id','empid','hallnameid','monthyear','amount','bonus'];



}
