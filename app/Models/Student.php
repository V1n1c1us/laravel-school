<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','birth','gender','classroom_id'];

    // mapeamento do relacionamento com salas de aula
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    protected $casts = [
        'birth' => 'date:d/m/Y'
    ];
}
