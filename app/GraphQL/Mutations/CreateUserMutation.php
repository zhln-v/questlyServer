<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Str;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CreateUserMutation
{
    /**
     * Создать нового пользователя.
     *
     * @param  null  $root
     * @param  array  $args
     * @param  GraphQLContext  $context
     * @param  ResolveInfo  $resolveInfo
     * @return \App\Models\User
     */
    public function __invoke($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // Валидация данных
        $data = [
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),  // Хэшируем пароль
        ];

        // Создаём пользователя
        return User::create($data);
    }
}
