<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function product()
    {
        return $this->belongsToMany(product::class)->withPivot('qty');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}
