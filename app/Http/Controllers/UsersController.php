<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function index()
    {
		$users = Users::orderBy('Id','desc')->get();
        return view('users.index', compact('users'));
    }
    public function userRoleChange(Request $request)
    { 
        if($request->has('id')){
        Users::where('id', $request->id)  
        ->update( [
        'role' => $request->roleStatus,
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    }
    return Response()->json(['status'=>200]);
    }
    
}