<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
    protected $fillable = [];
    protected $guarded = [];

    protected $attributes = array(
        'options'  => '{"left":0, "top":0, "width":0, "height": 0}',
    );
    /*
    public __construct(array $attributes)
    {
        $this->attributes['options'] = '{"left":0, "top":0, "width":0, "height": 0}';
        parent::__construct($attributes);
    }
    */
}
