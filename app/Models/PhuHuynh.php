<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhuHuynh extends Model
{
    use HasFactory;
    protected $fillable = [
        "phuhuynh_id", "hoten", "gender", "tuoi", "ngaysinh", "sdt", "diachi", "cmnd", "avatar","vaitro","nghenghiep"
    ];
    protected $table = "phuhuynh";
    protected $primaryKey = "phuhuynh_id";
    protected $keyType = 'string';
    public function getAll(){
        $parent = DB::table($this->table)->get();
        return $parent;
    }
}
