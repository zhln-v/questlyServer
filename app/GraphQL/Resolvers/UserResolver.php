<?php

namespace App\GraphQL\Resolvers;

use App\Models\User;

class UserResolver
{
    /**
     * Получить пользователя по id или email.
     *
     * @param  mixed  $root
     * @param  array  $args
     * @return \App\Models\User|null
     */
    public function resolve($root, array $args)
    {
        if (isset($args['id'])) {
            return User::find($args['id']);
        }

        if (isset($args['email'])) {
            return User::where('email', $args['email'])->first();
        }

        return null;
    }
}
