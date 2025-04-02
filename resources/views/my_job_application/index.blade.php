<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Job Application' => '#']"/>

    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-xs text-slate-500">
                <div>
                    <div>Applied {{$application->created_at->diffForHumans()}}</div>
                    <div>
                        Your Expected Salary $ {{number_format($application->expected_salary)}}
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{route('my-job-applications.destroy',$application)}}">
                        @csrf
                        @method('DELETE')
                        <x-button-blade>Cancel</x-button-blade>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-700 p-8">
            <div class="text-center font-medium">
                No Application Yet
            </div>
            <div class="text-center font-medium">
                Find New Jobs <a class="text-blue-700 hover:underline" href="{{route('jobs.index')}}">Here!</a> 
            </div>
        </div>
    @endforelse
</x-layout>