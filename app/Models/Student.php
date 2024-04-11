<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /* public $student;

    public function __construct(Student $student){
        $this->student = $student;
    } */
    use HasFactory;
    protected $fillable = [
        "hocsinh_id", "hoten", "gender", "tuoi", "ngaysinh", "sdt", "diachi", "cmnd", "avatar"
    ];

    protected $table = 'hocsinh';
    protected $primaryKey = 'hocsinh_id';
    // ác định primary_key là chuỗi vì mặc định trong laravel là int
    protected $keyType = 'string';
    public function getAllStudents()
    {
        return $this->all();
    }
}
