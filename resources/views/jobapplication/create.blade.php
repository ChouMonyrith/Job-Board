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
        <form action="{{route('job.application.store',$job)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label :required="true" class="mb-2 block text-sm font-medium text-slate-900" for="expected_salary">Expected Salary</x-label>
                <x-text-input type="number" name="expected_salary"/>
            </div>
            <div class="mb-4">
                <x-label for="cv" :required="true" class="mb-2 block text-sm font-medium text-slate-900" >
                    Upload CV
                </x-label>
                <x-text-input type="file" name="cv"/>
            </div>
            <x-button-blade class="w-full cursor-pointer">Apply</x-button-blade>
        </form>
    </x-card>
</x-layout>