<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Categoria extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function materiais()
    {
        return $this->hasMany(Material::class);
    }
}
