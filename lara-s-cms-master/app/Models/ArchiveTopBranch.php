<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ArchiveTopBranch extends Model
{
    protected $table = 'archive_top_branches';
    //
    protected $fillable = [
        'branch_id', 'rank', 'created_at'
    ];
}
