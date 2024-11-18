<?php

declare(strict_types=1);

namespace App\GraphQL\Types;
use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Type as GraphQLType;

class TodoListType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'TodoList',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The ID of the todo list',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of the todo list',
            ],
            'status' => [
                'type' => Type::boolean(),
                'description' => 'The description of the todo list',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The creation timestamp',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The update timestamp',
            ],
        ];
    }
}
