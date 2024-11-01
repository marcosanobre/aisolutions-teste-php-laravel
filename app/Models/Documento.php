<?php

namespace App\Models;

use App\Models\DocumentoItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documento';

    public function itens()
    {
        return $this->hasMany(DocumentoItem::class, 'documento_id');
    }

}
