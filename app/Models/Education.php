<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    protected $primaryKey = 'id';
    // veritabanından kullanacağımız alanları filltable ile alanları içine yazıyoruz.
//    protected $fillable = [];
    //veritabanındaki alanların hepsini getirmek için guarded kullanıyoruz.boş dizi içerisine hepsi otomatik çekiyor. Kullanmak istemediğimiz alanları içine yazıyoruz.
    protected $guarded = [];

    public function scopeStatusActive($query)
    {
        return $query->where('status', 1);
    }
}
