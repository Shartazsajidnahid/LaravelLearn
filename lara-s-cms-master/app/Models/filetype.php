<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class filetype extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'filetypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filetype', 'created_at', 'updated_at', 'deleted_at'
    ];
}
