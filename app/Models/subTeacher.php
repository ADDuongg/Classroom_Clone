<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subTeacher extends Model
{

    use HasFactory;
    protected $fillable = [
        "id", "lophoc_id", "giaovien_id"
    ];

    protected $table = 'subteacher';
    protected $primaryKey = 'id';
}
