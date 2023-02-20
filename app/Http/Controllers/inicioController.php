<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class inicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $users_ene = DB::table('users')
        ->whereBetween('created_at', ['2020-01-01 00:00:00', '2020-01-31 23:59:59'])
        ->count();

        $users_feb = DB::table('users')
        ->whereBetween('created_at', ['2020-02-01 00:00:00', '2020-02-28 23:59:59'])
        ->count();

        $users_mar = DB::table('users')
        ->whereBetween('created_at', ['2020-03-01 00:00:00', '2020-03-31 23:59:59'])
        ->count();

        $users_abr = DB::table('users')
        ->whereBetween('created_at', ['2020-04-01 00:00:00', '2020-04-30 23:59:59'])
        ->count();

        $users_may = DB::table('users')
        ->whereBetween('created_at', ['2020-05-01 00:00:00', '2020-05-30 23:59:59'])
        ->count();

        $users_jun = DB::table('users')
        ->whereBetween('created_at', ['2020-06-01 00:00:00', '2020-06-30 23:59:59'])
        ->count();

        $users_jul = DB::table('users')
        ->whereBetween('created_at', ['2020-07-01 00:00:00', '2020-07-31 23:59:59'])
        ->count();

        $users_ago = DB::table('users')
        ->whereBetween('created_at', ['2020-08-01 00:00:00', '2020-08-31 23:59:59'])
        ->count();

        $users_sep = DB::table('users')
        ->whereBetween('created_at', ['2020-09-01 00:00:00', '2020-09-30 23:59:59'])
        ->count();

        $users_oct = DB::table('users')
        ->whereBetween('created_at', ['2020-10-01 00:00:00', '2020-10-31 23:59:59'])
        ->count();

        $users_nov = DB::table('users')
        ->whereBetween('created_at', ['2020-11-01 00:00:00', '2020-11-30 23:59:59'])
        ->count();

        $users_dic = DB::table('users')
        ->whereBetween('created_at', ['2020-12-01 00:00:00', '2020-12-31 23:59:59'])
        ->count();

        return view('inicio')->with(array(
            'users_ene' => $users_ene,
            'users_feb' => $users_feb,
            'users_mar' => $users_mar,
            'users_abr' => $users_abr,
            'users_may' => $users_may,
            'users_jun' => $users_jun,
            'users_jul' => $users_jul,
            'users_ago' => $users_ago,
            'users_sep' => $users_sep,
            'users_oct' => $users_oct,
            'users_nov' => $users_nov,
            'users_dic' => $users_dic,
        ));
    }
}
