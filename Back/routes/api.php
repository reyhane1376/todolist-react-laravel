<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\GraphQLController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/graphql', [GraphQLController::class, 'query']);
