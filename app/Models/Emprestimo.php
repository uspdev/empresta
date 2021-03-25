<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Visitante;

class Emprestimo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function visitante()
    {
        return $this->belongsTo(Visitante::class);
    }

    public static function visitantesOptions(){
        return Visitante::all();
    }
}
