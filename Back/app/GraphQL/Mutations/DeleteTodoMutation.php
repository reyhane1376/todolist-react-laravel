<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Todolist;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DeleteTodoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteTodo',
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
        ];
    }

    public function resolve($root, $args)
    {
        $todo = Todolist::find($args['id']);
        if ($todo) {
            $todoDetails = $todo->toArray();
            $todo->delete();
            return $todoDetails;
        }
    
        return null;
    }
}
