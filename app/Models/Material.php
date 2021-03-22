<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Material extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function categoriasOptions(){
        return Categoria::all()->toArray();
    }
}
