<?php

namespace App\GraphQL\Mutations;

use App\Models\Todolist;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateTodoStatusMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTodoStatus',
    ];

    public function type(): Type
    {
        return GraphQL::type('TodoList');
    }

    public function args(): array
    {
        return [
            'id' => [
               'name'        => 'id',
               'type'        => Type::nonNull(Type::int()),
               'description' => 'The ID of the todo item'
            ],
            'status' => [
                'name'        => 'status',
                'type'        => Type::boolean(),
                'description' => 'The new status of the todo item'
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $todo = Todolist::find($args['id']);

        if ($todo) {
            $todo->status = $args['status'];
            $todo->save();

            return $todo;
        }

        return null;
    }
}
