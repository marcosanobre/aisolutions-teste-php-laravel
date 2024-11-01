<?php

namespace App\Models;

use App\Models\Remessa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilaTarefa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tarefa';

    public function remessa()
    {
        return $this->belongsTo(Remessa::class, 'remessa_id');
    }

}
