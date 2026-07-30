<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminCursoCreateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Http\Request;

class courseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return CourseResource::collection($courses)->additional([
            "success" => true
        ])->response()->setStatusCode(200);
    }

    public function store(adminCursoCreateRequest $request)
    {

        $credentials = $request->validated();

        $professor = Professor::find($credentials['professor_id']);

        if (!$professor) {
            return response()->json([
                'success' => false,
                'msg' => 'Esse Professor não existe'
            ], 404);
        }

        $course = Course::create([
            'name' => $credentials['name'],
            'workload' => $credentials['workload'],
            'price' => $credentials['price'],
            'description' => $credentials['description'] ?? null,
            'professor_id' => $credentials['professor_id']
        ]);

        if (!$course) {
            return response()->json([
                'success' => false,
                'msg' => 'Erro ao criar curso'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $course,
            'msg' => 'Curso criado com sucesso'
        ], 201);

    }
}
