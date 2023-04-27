<?php

namespace App\Http\Controllers\Api\v1;

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
                        ->orWhere('cpf', 'LIKE', "%{$request->name}%")
                        ->orWhere('ra', 'LIKE', "%{$request->name}%")
                        ->paginate(5);

        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'ra' => 'required|max:10|unique:students,ra',
            'cpf' => 'required|max:11|unique:students,cpf'
        ]);

       $student = $this->student->create($request->all());

    
       return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$student = $this->student->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        return response()->json($student, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!$student = $this->student->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'ra' => 'required|max:10|unique:students,ra,' . $id,
            'cpf' => 'required|max:11|unique:students,cpf,' . $id
        ]);
        
        $student->update($request->all());
        
        return response()->json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$student = $this->student->find($id))
            return response()->json(['error' => 'Not Found'], 404);
        
        $student->delete();

        return response()->json(['success' => true], 204);

    }
}
