<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">Sign In</h1>
    <x-card class="py-8 px-16">
        <form action="{{route('auth.store')}}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="email" :required="true" class="mb-2 block text-sm font-medium text-slate-900">E-mail</x-label>
                <x-text-input name="email" type='mail'></x-text-input>
            </div>
            <div class="mb-8">
                <x-label for="password" :required="true" class="mb-2 block text-sm font-medium text-slate-900">Password</x-label>
                <x-text-input name="password" type="password"></x-text-input>
            </div>
            <div class="mb-8 flex justify-between">
                <div>
                    <div class="flex items-center space-x-1">
                        <input class="rounded-sm border border-slate-500" type="checkbox" name="remember" id="">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
                <div>
                    <a href="#" class="text-indigo-600 hover:underline">
                        Forgot Password
                    </a>
                </div>
            </div>
            <x-button-blade class="w-full bg-blue-200">Login</x-button-blade>
        </form>
    </x-card>
</x-layout>