<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs'=>route('jobs.index'),$job->title=>'#']"></x-breadcrumbs>
    <x-job-card :job="$job">
        <p class="text-sm text-slate-500 mb-4">{{$job->description}}</p>
        @can('apply', $job)
        <x-link-button :href="route('job.application.create',$job)">
            Apply
        </x-link-button>
        @else
        <div class="text-center text-sm font-medium text-slate-500">
            You've already applied
        </div>
        @endcan
    </x-job-card>
    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            More Jobs From {{$job->employer->company_name}}
        </h2>
        <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $employerJobs)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-s">
                            <a href="{{route('jobs.show',$employerJobs)}}">
                                {{$employerJobs->title}}
                            </a>
                        </div>
                        <div class="text-s">
                            {{ $employerJobs->created_at ? $employerJobs->created_at->diffForHumans() : 'N/A' }}
                        </div>
                    </div>
                    <div class="text-s">
                        $ {{number_format($employerJobs->salary)}}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>