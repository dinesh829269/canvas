<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class service_catelog extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_catelogs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','sequence', 'parent_id', 'image'];

    public function parent_category() {
        return $this->belongsTo('App\service_catelog', 'parent_id');
    }

    /**
     * Get the Child record 
     */
    public function get_child_categories() {
        return $this->hasMany('App\service_catelog', 'parent_id');
    }

   

}
