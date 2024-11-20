<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Todolist;

class TodoListQuery extends Query
{
    protected $attributes = [
        'name'        => 'todoList',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('TodoList'));
    }

    public function args(): array
    {
        return [
            'status' => [
                'type' => Type::boolean(),
                'description' => 'Filter by task status (true for completed, false for pending)',
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
    $fields = $getSelectFields();
    $select = $fields->getSelect();
    $with = $fields->getRelations();

    $query = TodoList::select($select)->with($with);

    if (isset($args['status'])) {
        $query->where('status', $args['status']);
    }

    return $query->latest()->get();
    }
}
