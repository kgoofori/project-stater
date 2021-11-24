<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        return view('dashboard.home', compact('user'));
    }

    public function intro()
    {
        return view('dashboard.intro');
    }

    public function introSetup(Request $request)
    {
        $types = implode(',', ['SHOPPER', 'SELLER']);
        $request->validate(
            ['type' => "required|in:{$types}"]
        );

        auth()->user()->changeType($request->type);

        return redirect('/dashboard');
    }
}
