<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Users;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usercount = Users::get()->count();
        return view('dashboard.index', compact('usercount'));
    }
}