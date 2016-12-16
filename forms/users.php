<?php
return [
    'model' => App\User::class,
    'route_name' => 'users',
    'per_page' => 5,
    'create_form' => [
        [
            'label' => 'Full name', // Label for fields
            'type' => 'text', // Available types: text, password, textarea
            'name' => 'name', // Field name
            'database_field' => 'name', //false or database field name
            'validation_rules' => 'required', //Laravel validation rules
            'storing_method' => null, // Custom storing method
        ],
        [
            'label' => 'Email address',
            'type' => 'email',
            'name' => 'email',
            'database_field' => 'email',
            'validation_rules' => 'required|email',
            'storing_method' => null,
        ],
        [
            'label' => 'Password',
            'type' => 'password',
            'name' => 'password',
            'database_field' => 'password',
            'validation_rules' => 'required|min:6|confirmed',
            'storing_method' => function($value) { return bcrypt($value); },
        ],
        [
            'label' => 'Password again',
            'type' => 'password',
            'name' => 'password_confirmation',
            'database_field' => false,
            'validation_rules' => '',
            'storing_method' => null,
        ],
    ],
    'edit_form' => [
        [
            'label' => 'Full name', // Label for fields
            'type' => 'text', // Available types: text, password, textarea
            'name' => 'name', // Field name
            'database_field' => 'name', //false or database field name
            'validation_rules' => 'required', //Laravel validation rules
            'storing_method' => null, // Custom storing method
            'editable' => true, // Is field editable, default is true
        ],
        [
            'label' => 'Email address',
            'type' => 'email',
            'name' => 'email',
            'database_field' => 'email',
            'validation_rules' => 'required|email',
            'storing_method' => null,
            'editable' => true,
        ],
        [
            'label' => 'Password',
            'type' => 'password',
            'name' => 'password',
            'database_field' => 'password',
            'validation_rules' => 'min:6|confirmed',
            'storing_method' => function($value) { return bcrypt($value); },
            'editable' => true,
        ],
        [
            'label' => 'Password again',
            'type' => 'password',
            'name' => 'password_confirmation',
            'database_field' => false,
            'validation_rules' => '',
            'storing_method' => null,
            'editable' => true,
        ],
        [
            'label' => 'Created at',
            'type' => 'text',
            'name' => 'created',
            'database_field' => 'created_at',
            'editable' => false,
        ],
    ],
    'list' => [
        [
            'database_field' => 'name',
            'label' => 'Name',
        ],
        [
            'database_field' => 'email',
            'label' => 'Email',
        ],
        [
            'database_field' => 'created_at',
            'label' => 'Created At',
        ],
    ],
];
