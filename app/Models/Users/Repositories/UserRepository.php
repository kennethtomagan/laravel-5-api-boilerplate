<?php
namespace App\Models\Users\Repositories;

use App\Models\Users\User;
use Jsdecena\Baserepo\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $user) 
    {
        parent::__construct($user);
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