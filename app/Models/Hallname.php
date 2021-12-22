<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hallname extends Model
{
    use HasFactory;

    
    protected $table='hallname';
    protected $fillable=['id','hallname','hallpic','gender'];
}
