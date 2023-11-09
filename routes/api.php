<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceToController;
use App\Http\Controllers\ThirdPartyInstructionController;
use App\Http\Controllers\VendorAddressController;
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

// Route Api For Auth User
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/profile',  [AuthController::class, 'getAuthenticatedUser'])->name('getAuthenticatedUser');
});


// Routes Api for Create Third Party Instruction
Route::group([

    // 'middleware' => 'todo.auth',
    // 'prefix' => 'api'

], function () {
    // Routes for Create Third Party Instruction
    Route::post('/new3Party', [ThirdPartyInstructionController::class, 'create']);
    // Route::get('/', [TodoListController::class, 'getTodoList']);
    // Route::get('/{id}', [TodoListController::class, 'show']);
    // Route::put('/{id}', [TodoListController::class, 'update']);
    // Route::delete('/{id}', [TodoListController::class, 'destroy']);
});

// Route Api For InvoiceTo 
Route::group([], function () {
    // Routes for Todos
    Route::post('/invoiceTo', [InvoiceToController::class, 'create']);
});

// Route Api For Vendor Address 
Route::group([], function () {
    // Routes for Todos
    Route::post('/vendorAddress', [VendorAddressController::class, 'create']);
});
