<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Students as StudentCollection;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::info('Listou os Usuários');

        if ($request->query('includes') === 'classroom') {
            $students = Student::with('classroom')->paginate(2);
        } else {
            $students = Student::paginate(2);
        }
        return (new StudentCollection($students))
                    ->response()
                    ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Validator error => 422
     */
    public function store(StudentRequest $request)
    {
        Log::info('Cadastrado com Sucesso');

        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Pega o student vindo do banco, formata ele e retorna o array
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Student $student = $id
     * @return \Illuminate\Http\Response
     * Student $student = $id
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->all());

        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student = $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return [];
    }
}
