<?php

namespace App\GraphQL\Queries;

use App\Models\User;

class UserQuery
{
    /**
     * Получить пользователя по id или email.
     *
     * @param  mixed  $root
     * @param  array  $args
     * @return \App\Models\User|null
     */
    public function __invoke($root, array $args)
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
