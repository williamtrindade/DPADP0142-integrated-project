<?php

use App\Http\Transformers\UserTransformer;
use App\User;

/*
|--------------------------------------------------------------------------
| Default transformers
|--------------------------------------------------------------------------
|
| Here you may register default transformers, this transformers will be
| used when you try to transform an eloquent model without specifying a
| transformer, feel free to register as many as you need.
|
*/
return [
    'transformers' => [
        User::class => UserTransformer::class
    ]
];
