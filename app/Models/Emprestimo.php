<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Visitante;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function visitantesOptions(){
        return Visitante::all();
    }
}
