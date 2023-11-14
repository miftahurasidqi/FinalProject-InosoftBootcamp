<?php

use App\Http\Controllers\AssignedVendorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerContractController;
use App\Http\Controllers\InvoiceToController;
use App\Http\Controllers\LinkToController;
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
    Route::post('/new3Party', [ThirdPartyInstructionController::class, 'store']);
    // Route::get('/', [TodoListController::class, 'getTodoList']);
    // Route::get('/{id}', [TodoListController::class, 'show']);
    // Route::put('/{id}', [TodoListController::class, 'update']);
    // Route::delete('/{id}', [TodoListController::class, 'destroy']);
});

// Route Api For Link To
Route::group(['prefix' => 'linkTo'], function () {
    Route::post('/', [LinkToController::class, 'store']);
    Route::get('/', [LinkToController::class, 'getLinkToList']);
    Route::get('/{id}', [LinkToController::class, 'show']);
    Route::put('/{id}', [LinkToController::class, 'update']);
    Route::delete('/{id}', [LinkToController::class, 'delete']);
});

// Route Api For Assigned Vendor
Route::group(['prefix' => 'assignedVendor'], function () {
    Route::post('/', [AssignedVendorController::class, 'store']);
    Route::get('/', [AssignedVendorController::class, 'getAssignedVendorList']);
    Route::get('/{id}', [AssignedVendorController::class, 'show']);
    Route::put('/{id}', [AssignedVendorController::class, 'update']);
    Route::delete('/{id}', [AssignedVendorController::class, 'delete']);
});

// Route Api For Vendor Address 
Route::group(['prefix' => 'vendorAddress'], function () {
    Route::post('/', [VendorAddressController::class, 'store']);
    Route::get('/', [VendorAddressController::class, 'getVendorAddressList']);
    Route::get('/{id}', [VendorAddressController::class, 'show']);
    Route::put('/{id}', [VendorAddressController::class, 'update']);
    Route::delete('/{id}', [VendorAddressController::class, 'delete']);
});

// Route Api For InvoiceTo 
Route::group(['prefix' => 'invoiceTo'], function () {
    Route::post('/', [InvoiceToController::class, 'store']);
    Route::get('/', [InvoiceToController::class, 'getInvoiceToList']);
    Route::get('/{id}', [InvoiceToController::class, 'show']);
    Route::put('/{id}', [InvoiceToController::class, 'update']);
    Route::delete('/{id}', [InvoiceToController::class, 'delete']);
});

// Route Api For Customer Contract
Route::group(['prefix' => 'customerContract'], function () {
    Route::post('/', [CustomerContractController::class, 'store']);
    Route::get('/', [CustomerContractController::class, 'getCustomerContractList']);
    Route::get('/{id}', [CustomerContractController::class, 'show']);
    Route::put('/{id}', [CustomerContractController::class, 'update']);
    Route::delete('/{id}', [CustomerContractController::class, 'delete']);
});
