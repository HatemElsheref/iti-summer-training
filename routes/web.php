<?php

use Illuminate\Support\Facades\Route;

#   Session 1
function getAllClients(){
    return [
        [
            'title'     =>'Developer',
            'name'      =>'Hatem Mohamed',
            'age'       =>21,
            'address'   =>'Tanta',
            'email'     =>'hatem@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Ahmed Mohamed',
            'age'       =>23,
            'address'   =>'Tanta',
            'email'     =>'ahmed@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Sara Ali',
            'age'       =>15,
            'address'   =>'Tanta',
            'email'     =>'sara@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Ahmed Fathy',
            'age'       =>18,
            'address'   =>'Tanta',
            'email'     =>'ahmed_fathy@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Heba Hamdy',
            'age'       =>17,
            'address'   =>'Tanta',
            'email'     =>'heba@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Mohamed Gaber',
            'age'       =>35,
            'address'   =>'Tanta',
            'email'     =>'mo_gaber@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Shrouk Ibrahim',
            'age'       =>26,
            'address'   =>'Tanta',
            'email'     =>'shosho@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Abo Alashwak',
            'age'       =>22,
            'address'   =>'Tanta',
            'email'     =>'showky@iti.org'
        ],
        [
            'title'     =>'Developer',
            'name'      =>'Amira Fouda',
            'age'       =>19,
            'address'   =>'Tanta',
            'email'     =>'mera@iti.org'
        ]
    ];
}

Route::get('/', function () {
    $message='Welcome Welcome Laravel With ITI';
    return view('session1.home',compact('message'));
})->name('home');

Route::get('/clients', function () {
   $clients=collect(getAllClients());
    return view('session1.clients',compact('clients'));
})->name('clients');

Route::get('/about', function () {
    $message='Welcome Welcome To ITI';
    return view('session1.about',compact('message'));
})->name('about');

Route::get('/contact', function () {
    $data=[
        'address'  =>'Smart Village',
        'email'  =>'support@iti.org',
        'phone'  =>'+201090703457'
    ];
    $info = new stdClass();
    foreach ($data as $key=>$value){
        $info->$key=$value;
    }
    return view('session1.contact',compact('info'));
})->name('contact');

Route::get('/my-account/{name?}', function ($name='Hatem Mohamed') {
$data=[
    'name'  =>'My Name Is '.$name,
    'email'  =>'My Email Is '.$name.'@iti.org',
    'message'  =>'This Is Open Source Track Sponsored By ITI'
];
$info = new stdClass();
foreach ($data as $key=>$value){
    $info->$key=$value;
}
return view('session1.profile',compact('info'));
})->name('profile');

# Session 2

Route::get('/posts','PostController@index')->name('posts.index');
Route::get('/posts/{post}','PostController@show')->name('posts.show');