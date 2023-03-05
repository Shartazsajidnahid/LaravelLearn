<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //

    protected $table = 'menus';

    protected $fillable = [
        'menu_title', 'parent_id', 'sort_order', 'controller_id', 'function_id' ,'slug',  'created_at', 'updated_at'
    ];

    public function parent()
    {
        return $this->hasOne('App\Models\Menu', 'id', 'parent_id')->orderBy('sort_order');
    }

    public function children()
    {

        return $this->hasMany('App\Models\Menu', 'parent_id', 'id')->orderBy('sort_order');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', '0')->orderBy('sort_order')->get();
}
}
