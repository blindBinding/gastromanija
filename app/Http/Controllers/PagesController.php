<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Gastromanija',
            'recepti' => (['recept', 'kuhinja'])
        ); 
        // return view('pages.index', compact('title'));
        return view('pages.index')->with($data);


    }

    public function admin(){
        $title = 'Admin';
        // return view('pages.admin');
        return view('pages.admin')->with('title', $title);
    }

    public function user(){
        $title = 'User';
        // return view('pages.user');
        return view('pages.user')->with('title', $title);
    }
}
