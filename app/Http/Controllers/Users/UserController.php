<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\Repositories\UserRepository;
use App\Models\Users\User;
use App\Models\Users\Repositories\UserRepositoryInterface;
use Illuminate\Hashing\BcryptHasher;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepo;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
    
        $this->userRepo = $userRepository;
    }

    public function index() 
    {
        // $userRepo = new UserRepository(new User);
        $users = $this->userRepo->all();
        
        $data = $this->userRepo->transformUsers($users)->toArray();

        return response()->json($data);    
    }
    
    public function store(Request $request)
    {
        // do data validation
    
        try {
            $this->validate($request, [
                'email' => 'required|unique:users,email'
            ]);
            
            $data = $request->only('name', 'email', 'password');

            $data['password'] = (new BcryptHasher)->make($data['password']);

            $user = $this->userRepo->create($data);

            $data = $this->userRepo->transform($user)->toArray();
    
            return response()->json($data, 201);
        
        } catch (Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'user_cannot_create',
                'message' => $e->getMessage()
            ]);        
        }
    }

    public function show($id)
    {
        // do data validation
        
        try {
            
            $user = $this->userRepo->findOneOrFail($id);
            
            $data = $this->userRepo->transform($user)->toArray();
    
            return response()->json($data);
            
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'user_no_found',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function update(Request $request, $id)
    {
        // do data validation
        
        try {
            
            $user = $this->userRepo->findOneOrFail($id);
            
            // Create an instance of the repository again 
            // but now pass the user object. 
            // You can DI the repo to the controller if you do not want this.
            $userRepo = new UserRepository($user);
            
            $userRepo->update($request->all());

            $data = $this->userRepo->transform($user)->toArray();

            return response()->json($data, 201);
            
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'user_no_found',
                'message' => $e->getMessage()
            ]);            
            
        } catch (Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'user_cannot_update',
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function destroy($id)
    {
        // do data validation
        
        try {

            $user = $this->userRepo->findOneOrFail($id);
            
            // Create an instance of the repository again 
            // but now pass the user object. 
            // You can DI the repo to the controller if you do not want this.
            $userRepo = new UserRepository($user);
            
            $userRepo->delete();

            $users = $this->userRepo->all();

            $data = $this->userRepo->transformUsers($users)->toArray();
    
            return response()->json($data);
            
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'user_no_found',
                'message' => $e->getMessage()
            ]);            
            
        } catch (Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'user_cannot_delete',
                'message' => $e->getMessage()
            ]);
        }
    }    
}
