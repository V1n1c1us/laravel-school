<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
    * indica os atributos para definiçao de dados
    *
    * @var array
    */
    protected $fillable = ['name','birth','gender','classroom_id'];

    // mapeamento do relacionamento com salas de aula
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    // /**
    // * converte na serialização
    // *
    // * @var array
    // */
    // protected $casts = [
    //     'birth' => 'date:d/m/Y'
    // ];

    // /**
    // * Define atributos não mostrados depois da serialização
    // *
    // * @var array
    // */
    // protected $hidden = [
    //     'created_at',
    //     'updated_at'
    // ];

    // //Global
    // protected $visible = [
    //     'name',
    //     'gender',
    //     'birth',
    //     'classroom_id'
    // ];
}
