<?php
namespace App\Models\Users\Repositories;

use App\Models\Users\User;
use Jsdecena\Baserepo\BaseRepository;
use App\Models\Users\Transformers\UserTransformer;
use Illuminate\Support\Collection;
use League\Fractal\Scope;

class UserRepository extends BaseRepository
{
    public function __construct(User $user) 
    {
        parent::__construct($user);
    }

    /**
     * @param Collection $collection
     * @param string $includes
     * @return \League\Fractal\Scope
     */
    public function transformUsers(Collection $collection, string $includes = null) : Scope
    {
        return $this->processCollectionTransformer($collection, new UserTransformer, 'users', $includes);
    }

    /**
     * @param User $user
     * @param string $includes
     * @return \League\Fractal\Scope
     */
    public function transform(User $user, string $includes = null) : Scope
    {
        return $this->processItemTransformer($user, new UserTransformer, 'users', $includes);
    }
    
    public function createUser(array $data) : User
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new \Exception($e);
        }
    }

}