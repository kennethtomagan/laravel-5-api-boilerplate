<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users\Repositories\UserRepository;
use App\Models\Users\User;

class UserController extends Controller
{
    public function index() 
    {
        $userRepo = new UserRepository(new User);
        $user = $userRepo->all();

        return response()->json($user);    
    }
    
    public function store(Request $request)
    {
        // do data validation
    
        try {
            $this->validate($request, [
                'email' => 'required|unique:users,email'
            ]);
            
            $userRepo = new UserRepository(new User);
            $user = $userRepo->createUser($request->all());
    
            return response()->json($user, 201);
        
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
            
            $userRepo = new UserRepository(new User);
            $user = $userRepo->findOneOrFail($id);
    
            return response()->json($user);
            
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
            
            $userRepo = new UserRepository(new User);
            $user = $userRepo->findOneOrFail($id);
            
            // Create an instance of the repository again 
            // but now pass the user object. 
            // You can DI the repo to the controller if you do not want this.
            $userRepo = new UserRepository($user);
            
            $userRepo->update($request->all());

            return response()->json($user);
            
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

            $userRepo = new UserRepository(new User);
            $user = $userRepo->findOneOrFail($id);
            
            // Create an instance of the repository again 
            // but now pass the user object. 
            // You can DI the repo to the controller if you do not want this.
            $userRepo = new UserRepository($user);
            $userRepo->delete();

            $data = $userRepo->all();
    
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
