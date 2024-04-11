<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numberStudentInClass extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = [
        "lophoc_id", "hocsinh_id"
    ];
    protected $table = "soluonglop";
    protected $primary_key = "id";
}
