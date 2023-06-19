<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DB;
class HomeController extends Controller
{
    public function index(){
        $data = [];
        $users = DB::table('users')
                        ->get()
                        ->groupBy(function($users){
                            return Carbon::parse($users->created_at)->format('M');
                        });
        $data['users'] = [];
        $data['creches'] = [];
        $data['vendors'] = [];
        foreach($users as $month => $values){
            $data['users'][] = count($values->where('type','user'));
            $data['creches'][] = count($values->where('type','creche'));
            $data['vendors'][] = count($values->where('type','vendeur'));
            
            $data['usersmonth'][] = $month; 

        }
              
        return view('admin.index',$data);
    }

    public function settings(){
        return view('admin.settings.index');
    }
}
