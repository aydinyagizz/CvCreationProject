<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience';
    protected $primaryKey = 'id';
    // veritabanından kullanacağımız alanları filltable ile alanları içine yazıyoruz.
//    protected $fillable = [];
    //veritabanındaki alanların hepsini getirmek için guarded kullanıyoruz.boş dizi içerisine hepsi otomatik çekiyor. Kullanmak istemediğimiz alanları içine yazıyoruz.
    protected $guarded = [];
}
