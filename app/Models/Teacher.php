<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        "giaovien_id", "hoten", "gender", "tuoi", "ngaysinh", "sdt", "diachi", "cmnd", "avatar","bangcap","chucvu"
    ];
    protected $keyType = 'string';
    protected $table = 'giaovien';
    protected $primaryKey = 'giaovien_id';

}
