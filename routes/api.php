<?php

use App\Http\Controllers\Api\courseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/courses', [courseController::class, 'index'])->name('courses');
Route::middleware('auth:sanctum')->post('/courses/create', [courseController::class, 'store'])->name('courses.create');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = auth()->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    return response()->json([
        'success' => true,
        'msg' => 'Email ou Senha inválidos'
    ]);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {

    $request->user()->currentAccessToken()->delete();

    return response()->json([
        "success" => true,
        "msg" => "Usuário deslogado!"
    ]);
});

Route::middleware('auth:sanctum')->post('/logoutAll', function (Request $request) {
    $request->user()->tokens()->delete();

    return response()->json([
        "success" => true,
        "msg" => "Usuário deslogado de todas as contas"
    ]);
});