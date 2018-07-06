<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transcation;

use Auth;

class TranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $transcations = Transcation::where('user_id', $user->id);
        $transcations = $transcations->orderBy('id', 'desc');
        
        // request flash to access the old value
        $request->flash();
        
        $transcations = $transcations->paginate(20);
        $transcations->appends($request->all());
        
        return view('transcations.index', ['nav' => 'finance', 'transcations' => $transcations]);
    }
}
