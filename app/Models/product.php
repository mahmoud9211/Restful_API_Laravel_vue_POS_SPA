<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends =  ['profit_percentage'];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }

    public function getProfitPercentageAttribute()
    {
        $profit = $this->selling_price - $this->purchase_price;

        $profit_percentage = $profit * 100 / $this->purchase_price;

        return number_format($profit_percentage,2);
    }

}
