<x-layout>
    <x-breadcrumbs class="mb-4" :links="[
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show',$job),
        'Apply' => '#']">
    </x-breadcrumbs>
    <x-job-card :$job/>
    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            Your Job Application
        </h2>
        <form action="{{route('job.application.store',$job)}}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="mb-2 block text-sm font-medium text-slate-900" for="">Expected Salary</label>
                <x-text-input type="number" name="expected_salary"/>
            </div>
            <x-button-blade class="w-full cursor-pointer">Apply</x-button-blade>
        </form>
    </x-card>
</x-layout>