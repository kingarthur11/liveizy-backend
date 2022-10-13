<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserAuthRepository;
use App\Http\Controllers\AppBaseController;

class UserController extends AppBaseController
{
    private UserAuthRepository $userAuthRepository;

    public function __construct(UserAuthRepository $userAuthRepo)
    {
        $this->userAuthRepository = $userAuthRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function register(Request $request)
    {
        $response = $this->userAuthRepository->createUser($request);

        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['response_message']);
        } else {
            return $this->sendError($response['response_message'], $response['data']);
        }
    }

    public function login(Request $request)
    {

        $response = $this->userAuthRepository->loginUser($request);

        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['response_message']);
        } else {
            return $this->sendError($response['response_message'], $response['data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserById($id)
    {
        $response = $this->userAuthRepository->get_user_by_id($id);

        if ($response['status']) {
            return $this->sendResponse($response['data'], $response['response_message']);
        } else {
            return $this->sendError($response['response_message'], $response['data']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
