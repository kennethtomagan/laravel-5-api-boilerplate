<?php

namespace App\Models\Users\Transformers;

use App\Models\Users\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{

    protected $availableIncludes = [];

    public function transform(User $user)
    {
        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at->toDateTimeString(),
        ];
    }

}
