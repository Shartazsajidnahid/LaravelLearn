<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class files extends Model
{
    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'division_admin_id', 'file_type', 'filepath', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];
}
