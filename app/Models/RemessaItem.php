<?php

namespace App\Models;

use App\Models\Remessa;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RemessaItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'remessa_item';

    public function remessa()
    {
        return $this->belongsTo(Remessa::class, 'remessa_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}

