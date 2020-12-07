<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\belongTo;

class Order extends Model
{

    public function ingredient()
    {
        return $this->belongTo('App\Models\Ingredient');
    }

    public function getData()
    {
        return $this->ingredient->ingredients_name;
    }
}
