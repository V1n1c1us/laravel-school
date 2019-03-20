<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{

    protected $fillable = ['description'];

    // mapeamento do relacionamento com estudantes
    public function students(){
        return $this->hasMany(Student::class);
    }
}
