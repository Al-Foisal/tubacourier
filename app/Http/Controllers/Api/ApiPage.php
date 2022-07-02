<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class ApiPage extends Controller {
    public function pages(){
        return response()->json(['pages'=>Page::where('status',1)->get()]);
    }
    
    public function pageDetails($slug){
        return response()->json(['page'=>Page::where('slug',$slug)->first()]);
    }
}