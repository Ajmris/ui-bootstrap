<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("users.index", [
            'users'=>User::paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        //$user=User::find($id);
        try{
            $user->delete();
            Session::flash('status', __('actions.user deleted'));
            return response()->json([
                'status'=>'success'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>$e->getMessage(), // <-- to jest to co trafia do JS
            ])->setStatusCode(500);
        }
    }
}