<x-layout>
    <x-card>
        <form action="{{route('employer.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label for="company_name" :required="true">
                    Compan yName
                </x-label>
                <x-text-input name="company_name"/>
            </div>
            <x-button-blade class="w-full">Create</x-button-blade>
        </form>
    </x-card>
</x-layout>