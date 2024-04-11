<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToMonHoc extends Model
{
    use HasFactory;
    /* protected $fillable = [
        "hocsinh_id", "hoten", "gender", "tuoi", "ngaysinh", "sdt", "diachi", "cmnd", "avatar"
    ]; */
    protected $keyType = 'string';
    protected $table = 'tomonhoc';
    protected $primaryKey = 'tomonhoc_id';
}
