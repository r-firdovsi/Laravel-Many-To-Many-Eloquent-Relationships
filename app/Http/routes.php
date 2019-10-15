<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Role;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $user = User::find(1);
//    $role = new Role(['name'=>'Adminstrator']);

    $user->roles()->save(new Role(['name'=>'Adminstrator']));
});

Route::get('/read', function () {
   $user = User::findOrFail(1);

   foreach ($user->roles as $role) {
//       return $role;
       echo $role->name;
   }
});

Route::get('/update', function () {
   $user = User::findOrFail(1);

   if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name == 'Adminstrator') {
                $role->name = 'Subscribe';

                $role->save();
            }
        }
   };
});

Route::get('/delete', function () {
   $user = User::findOrFail(1);
//   $user->roles()->delete(); Delte All

    foreach ($user->roles as $role) {
        $role->whereId(4)->delete();
    }
});

Route::get('/attach', function () { // Istifadeciye yeni rolun elave olunmasi
    $user = User::findOrFail(1);

    $user->roles()->attach(6);
});

Route::get('/detach', function () { // Istifadeciye verilmis rolun alinmasi
    $user = User::findOrFail(1);

    $user->roles()->detach(6);
//    $user->roles()->detach(); // Butun Istifadecilere verilen rollarin alinmasi
});

Route::get('/sync', function ()  { // Bir defeye istifadeciye bir nece role elave elemek ucun hemde Istifaci rolunun
    // yenilenmesi ucun istifade olunur.
    $user = User::findOrFail(1);

    $user->roles()->sync([5, 6]);
});


