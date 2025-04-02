<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    use AuthorizesRequests;


    public function __construct()
    {
        $this->authorizeResource(Employer::class);
    }
    
    public function create()
    {
        return view('employer.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|min:3|unique:employers,company_name'
        ]);

        $employer = new Employer($validatedData);
        $employer->user_id = Auth::id();
        $employer->save();

        return redirect()->route('jobs.index')->with('success', 'Account Created');
    }

}
