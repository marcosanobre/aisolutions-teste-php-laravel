<?php

namespace App\Models;

use App\Models\RemessaItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Remessa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'remessa';

    public function itens()
    {
        return $this->hasMany(RemessaItem::class, 'remessa_id');
    }
}

