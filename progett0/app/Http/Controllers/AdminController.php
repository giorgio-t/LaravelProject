<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function index(){

        $viewData = [];
        $viewData['title'] = "Admin panel";
        return view('admin.home.index')->with("viewData",$viewData);
    }

    public function newsletter() {

        $viewData = [];
        $viewData['title'] = "Newsletter";
        $viewData['subtitle'] = "Send an email to the subscribers";

        return view('admin.newsletter.index')->with("viewData", $viewData);
    }
    

}