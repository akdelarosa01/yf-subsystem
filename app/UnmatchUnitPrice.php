<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnmatchUnitPrice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "unmatch_unitprice";

    protected $fillable = [
        'tid', 'lv', 'code','partname','vendor','price', 'r3_price', 'error'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
