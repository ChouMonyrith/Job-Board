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
        $this->authorize('apply',$job);

        $validateData = $request->validate([
            'expected_salary' => 'required|min:1|max:5000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs','private');

        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validateData['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show',$job)->with('success','Job Application Submitted');
    }

    
}
