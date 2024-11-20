<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\Todolist;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateTodoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTodo',
    ];

    public function type(): Type
    {
        return GraphQL::type('TodoList');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the todo',
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        return Todolist::create([
            'title' => $args['title'],
            'status' => false, // Default to pending
        ]);
    }
}
