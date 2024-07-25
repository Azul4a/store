<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWarehouse extends Model
{
    use HasFactory;

    protected $table = 'user_warehouses';
    public $timestamps = false;
}
