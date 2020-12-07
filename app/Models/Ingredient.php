<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Relations\hasMany;


class Ingredient extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
