<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('Listou os Usuários');

        $students = Student::all();

        return response()->json($students, Response::HTTP_OK);
       //return response(Student::all(), '200')->header('Content-Type','text/html', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * HTTP_CREATED => 201
     * HTTP_INTERNAL_SERVER_ERROR => 500
     */
    public function store(Request $request)
    {
        try{
            $strudent = Student::create($request->all());

            return response()->json($strudent, 201);
        }catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * HPPT_FOUND 302 => Found
     * HTTP_NOT_FOUND 404 => Not Found
     */
    public function show($id)
    {
        $student = Student::find($id);

        if($student) {
            return response()->json($student, 302);
        }

        return response()->json(['message' => 'Student not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * HTTP_NOT_FOUND => 404
     * HTTP_INTERNAL_SERVER_ERROR => 500
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }

        try{
            $student->update($request->all());

            return [];

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * HTTP_NOT_FOUND => 404
     * HTTP_INTERNAL_SERVER_ERROR => 500
     */
    public function destroy($id)
    {
        //
        $student = Student::find($id);

        if(!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        try{
            $student->delete();

            return [];

        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
