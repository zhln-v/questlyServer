<?php

namespace App\GraphQL\Types;

use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\Type;

class UserType implements Type
{
    /**
     * Поля типа.
     *
     * @return array
     */
    public function fields()
    {
        return [
            'id' => [
                'type' => 'ID',
            ],
            'name' => [
                'type' => 'String',
            ],
            'email' => [
                'type' => 'String',
            ],
            'email_verified_at' => [
                'type' => 'DateTime',
            ],
            'created_at' => [
                'type' => 'DateTime',
            ],
            'updated_at' => [
                'type' => 'DateTime',
            ],
        ];
    }
}
