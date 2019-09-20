<?php

namespace App\Models\Users\Repositories;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Models\Sites\Site;
use App\Models\Users\User;
use Illuminate\Support\Collection;
use League\Fractal\Scope;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function transformUsers(Collection $collection, string $includes = null) : Scope;

    public function transform(User $user, string $includes = null) : Scope;

}
