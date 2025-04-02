<x-layout>
    <x-breadcrumbs :links="['My Jobs'=>route('my-jobs.index'),'Create' =>'#']" class="mb-4"/>
    <x-card>
        <form action="{{route('my-jobs.store')}}" method="POST">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">
                        Title
                    </x-label>
                    <x-text-input name="title"/>
                </div>
                <div>
                    <x-label for="location" :required="true">
                        location
                    </x-label>
                    <x-text-input name="location"/>
                </div>
                <div class="col-span-2">
                    <x-label for="salary" :required="true">
                        Salary
                    </x-label>
                    <x-text-input name="salary"/>
                </div>
                <div class="col-span-2">
                    <x-label for="description" :required="true">
                        Description
                    </x-label>
                    <textarea name="description" id="description" class="form-input w-full ring-0 border rounded-md" rows="4"></textarea>
                </div>
                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group :all-option="false" name="experience_level" :options="array_combine(array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience)"/> 
                </div>
                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group :all-option="false" name="category" :options="\App\Models\Job::$category"/> 
                </div>
            </div>
            <div class="col-span-2">
                <x-button-blade class="w-full">Create</x-button-blade>
            </div>
        </form>
    </x-card>
</x-layout>