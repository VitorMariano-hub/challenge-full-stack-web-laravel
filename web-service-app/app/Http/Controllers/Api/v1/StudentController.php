<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StoreUpdateStudentRequest;

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
                        ->paginate(3);

        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateStudentRequest $request)
    {
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
    public function update(StoreUpdateStudentRequest $request, string $id)
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
        if(!$student = $this->student->find($id))
            return response()->json(['error' => 'Not Found'], 404);
        
        $student->delete();

        return response()->json(['success' => true], 204);

    }
}
