<?php

namespace App\Models;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentoItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documento_item';

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id');
    }

}
