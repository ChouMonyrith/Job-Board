<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    
    use AuthorizesRequests;
    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply',$job);
        return view('jobapplication.create',['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Job $job)
    {
        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            ...$request->validate([
                'expected_salary' => 'required|min:1|max:5000'
            ])
        ]);

        return redirect()->route('jobs.show',$job)->with('success','Job Application Submitted');
    }

    
}
