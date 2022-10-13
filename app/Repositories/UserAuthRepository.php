<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserAuthRepository extends BaseRepository
{
    
    protected $fieldSearchable = [];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }

    public function createUser($request)
    {

        $user_exist =  User::where('email', $request->email)->first();
        if ($user_exist) {
            return ['status' => false, 'response_message' => 'Email or phone number record already exist', 'data' => 'Email or phone number record already exist'];
        }
       
        $user = $this->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return ['status' => true, 'response_message' => 'User data created successfully', 'data' => $user];
    }

    public function loginUser($request)
    {
        $user_exist =  User::where('email', $request->email)->first();
        if(empty($user_exist)) {
            return ['status' => false, 'response_message' => "User does not exist", 'data' => "User does not exist"];
        }

        if (FacadesAuth::attempt($request->only(['email', 'password']))) {
            $authUser = FacadesAuth::user();

            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['user_details'] =  $authUser;

            return ['status' => true, 'response_message' => 'User signed in successfuly', 'data' => $success];
        } else {
            return ['status' => false, 'response_message' => 'Unauthorised user, email or password credentials incorrect', 'data' => 'Unauthorised user, email or password credentials incorrect'];
        }
    }

    /**
     * @Route("Route", name="RouteName")
     */
    public function get_user_by_id($user_id)
    {
        $user = $this->find($user_id);
        if(empty($user)) {
            return ['status' => false, 'response_message' => "User does not exist", 'data' => "User does not exist"];
        }

        return ['status' => true, 'response_message' => 'User data created successfully', 'data' => $user];
    }

}
