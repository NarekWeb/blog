<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application messages
    |--------------------------------------------------------------------------
     */

    'http' => [
        '404' => 'Route not found!',
        'healthy' => 'Healthy!',
        'model_not_found' => ':model not found!',
        'middleware' => [
            'ensure_user_has_role' => 'Access error! Following roles are required: :roles!',
        ],
        'access' => [
            'out_of_scope' => 'Resource request is out of user access scope!',
            'invalid_role' => 'Resource access error! Following roles are required: :roles!',
        ],
    ],

];
