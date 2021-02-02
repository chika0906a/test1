<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        //'name' => 'required',
        //'mail' => 'email',
        //'age' => 'integer|min:0|max:150'
        'support_num' => 'required',
        'mail' => 'required',
        'support_mail' => 'required',
        'day' => 'required',
        'support_text' => 'required',

    );
    public function getData()
    {
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }

    public function scopeNameEqual($query, $str)
    {
        return $query->where('name', $str);
    }

    public function scopeAgeGreaterThan($query, $n)
    {
        return $query->where('age', '>=', $n);
    }

    public function scopeAgeLessThan($query, $n)
    {
        return $query->where('age', '<=', $n);
    }

    public function board()
    {
        return $this->hasMany('App\Board');
    }

    public function subject()
    {
       return $this->hasOne('App\Subject');
    }

    public function subjects()
    {
       return $this->hasMany ('App\Subject');
    }
    
    
    use HasFactory;
}
