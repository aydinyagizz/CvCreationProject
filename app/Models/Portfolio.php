<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';
    protected $primaryKey = 'id';
    protected $guarded = [];

    // öne çıkan resimler
    public function featuredImage()
    {
        return $this->hasOne('App\Models\PortfolioImage', 'portfolio_id', 'id')
            ->where('featured', 1);
    }

    // tüm görselleri çekmek için
    public function images()
    {
        return $this->hasMany('App\Models\PortfolioImage', 'portfolio_id', 'id');
    }
}
