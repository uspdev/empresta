<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Emprestimo;
use App\Models\User;

class Material extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoriasOptions(){
        return Categoria::all()->toArray();
    }
}
