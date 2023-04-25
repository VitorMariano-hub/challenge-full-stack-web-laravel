<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = $this->student
                        ->where('name', 'LIKE', "%{$request->name}%")
                        ->get();

        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $student = $this->student->create($request->all());

       return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        if(!$student = $this->student->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $student->update($request->all());

        return response()->json($student, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
