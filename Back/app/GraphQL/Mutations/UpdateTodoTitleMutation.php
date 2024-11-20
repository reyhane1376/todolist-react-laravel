<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Todolist;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdateTodoTitleMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTodoTitle',
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
            'title' => [
                'name'        => 'title',
                'type'        => Type::string(),
                'description' => 'The new title of the todo item'
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $todo = Todolist::find($args['id']);

        if ($todo) {
            $todo->title = $args['title'];
            $todo->save();

            return $todo;
        }

        return null;
    }
}
