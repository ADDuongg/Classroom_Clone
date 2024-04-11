<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        "lophoc_id", "giaovien_id", "hocky_id", "soluong", "tenlop", "isActive","codeclass",'subteacher_id'
    ];
    protected $keyType = 'string';
    protected $table = 'lophoc';
    protected $primaryKey = 'lophoc_id';
}
