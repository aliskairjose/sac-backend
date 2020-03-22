<?php

use App\Mail\PasswordRecover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// estas rutas se pueden acceder sin proveer de un token válido.
Route::post('/auth/login', 'Api\AuthController@login');
Route::post('/auth/logout', 'Api\AuthController@logout');
Route::post('/auth/register', 'Api\RegisterController@register');


// Password Reset Routes
Route::post('password/email', 'Api\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Api\ResetPasswordController@reset')->name('password.reset');

Route::post('/correo', function (Request $request) {

    $email = $request->get('email');

    try {

        // Usando queue en lugar de send, el correo se envia en segundo plano!
        Mail::to($email)->queue(new PasswordRecover($email));
    } catch (\Exception $e) {
        return response()->json([
            'isSuccess' => false,
            'message' => 'No se pudo enviar el mail a ' . $email
        ]);
    }

    return response()->json([
        'isSuccess' => true,
        'messagge' => 'El mensaje ha sido enviado con exito a ' . $request->get('email') . '!.'
    ]);
});

// Route::group(['middleware' => ['jwt.verify']], function () {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::post('/logout', 'AuthController@logout');

    // Users Api's Routes
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::get('users/cedula/{id}', 'UserController@showByCedula');
    Route::post('users', 'UserController@store');
    Route::put('users/{id}', 'UserController@update');
    Route::post('users/{id}/photo/upload', 'UserController@uploadPhoto');
    Route::delete('users/{id}', 'UserController@delete');
    Route::get('users/main/{id}', 'UserController@mainBoard');

    // Building Api's Routes
    Route::get('buildings', 'BuildingController@index');
    Route::get('buildings/{id}', 'BuildingController@show');
    Route::post('buildings', 'BuildingController@store');
    Route::put('buildings/{id}', 'BuildingController@update');
    Route::delete('buildings/{id}', 'BuildingController@delete');

    // Accounts Routes
    Route::get('accounts', 'BankAccountController@index');
    Route::get('accounts/{id}', 'BankAccountController@show');
    Route::post('accounts', 'BankAccountController@store');
    Route::put('accounts/{id}', 'BankAccountController@update');
    Route::delete('accounts/{id}', 'BankAccountController@delete');

    // Owner Routes
    Route::get('owners', 'OwnerController@index');
    Route::get('owners/{id}', 'OwnerControlle@show');
    Route::post('owners', 'OwnerControlle@store');
    Route::put('owners/{id}', 'OwnerControlle@update');
    Route::delete('owners/{id}', 'OwnerControlle@delete');
// });
