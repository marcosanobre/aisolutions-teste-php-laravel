<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemessaItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'remessa_item';

    public function remessa()
    {
        return $this->belongsTo(Remessa::class, 'remessa_id');
    }
}

