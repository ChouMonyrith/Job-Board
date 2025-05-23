<x-card class="mb-4">
    <div class='flex justify-between mb-4'>
         <h2 class="text-lg font-medium"> {{$job->title}}</h2>
         <div class="text-slate-500">
             ${{number_format($job->salary)}}/month
         </div>
    </div>
    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
        <div class="flex">
             <div>{{$job->employer->company_name}}</div>
             <div class="px-1">{{$job->location}}</div>
        </div>
        <div class="flex space-x-1 text-xs">
             <x-tag>
               <a href="{{route('jobs.index',['experience_level' => ''])}}">
                    {{$job->experience_level}}
               </a>
             </x-tag>
             <x-tag>
               <a href="{{route('jobs.index',['category' => ''])}}">
                    {{$job->category}}
               </a>
          </x-tag>
        </div>
    </div>
    
    
    {{$slot}}
 </x-card>