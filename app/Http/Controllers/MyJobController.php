<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employer = Auth::user()->employer;

        if ($employer) {
            $jobs = $employer->jobs()->with(['employer', 'jobApplications.user'])->withTrashed()->get();
        } else {
            $jobs = collect(); // Return an empty collection if the user has no employer
        }

        return view('my_job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:250',
            'description' => 'required|string',
            'experience_level' => 'required|in:' . implode(',', \App\Models\Job::$experience),
            'category' => 'required|in:' . implode(',', \App\Models\Job::$category),
        ]);
        
        
        $employer = Auth::user()->employer;

        if (!$employer) {
            return redirect()->back()->withErrors(['error' => 'You must be an employer to create a job.']);
        }

        // Create the job
        $employer->jobs()->create($validateData);


        return redirect()->route('my-jobs.index')->with('success', 'Job created successfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        return view('my_job.edit', ['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:250',
            'description' => 'required|string',
            'experience_level' => 'required|in:' . implode(',', \App\Models\Job::$experience),
            'category' => 'required|in:' . implode(',', \App\Models\Job::$category),
        ]);

        $job = Job::findOrFail($id);

        $employer = Auth::user()->employer;

        if (!$employer || $job->employer_id !== $employer->id) {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to update this job.']);
        }

        $job->update($validateData);

        return redirect()->route('my-jobs.index')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();

        return redirect()->route('my-jobs.index')->with('success','Job Deleted Successfully');
    }
}
