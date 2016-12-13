<?php
return [
    'model' => App\User::class,
    'route_name' => 'users',
    'per_page' => 5,
    'form' => [
        [
            'db_field' => 'name',
            'field_type' => 'text',
            'validation_rules' => 'required',
            'label' => 'Name',
        ],
        [
            'db_field' => 'email',
            'field_type' => 'email',
            'validation_rules' => 'required|email',
            'label' => 'Email',
        ],
    ],
    'fields' => [
        [
            'db_field' => 'name',
            'label' => 'Name',
        ],
        [
            'db_field' => 'email',
            'label' => 'Email',
        ],
        [
            'db_field' => 'created_at',
            'label' => 'Created At',
        ],
    ],
];