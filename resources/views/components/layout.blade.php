<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="mx-auto mt-10 max-w-2xl bg-slate-100 text-slate-700 bg-gradient-to-r from-cyan-100 from- via-blue-400 via-">
        <nav class="mb-8 flex justify-between text-lg font-medium">
            <ul class="flex space-x-2">
                <li><a href="{{route('jobs.index')}}">Home</a></li>
            </ul>
            <ul class="flex space-x-2">
                @auth
                    <li>
                        <a href="{{route('my-job-applications.index')}}">
                            {{auth()->user()->name ?? "Anynomus"}}:Applications
                        </a>
                    </li>
                    <li>
                        <a href="{{route('my-jobs.index')}}">My Jobs</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('auth.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{route('auth.create')}}">Sign In</a></li>
                @endauth
            </ul>
        </nav>
        @if (session('success'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
                <p class="font-bold">Success!</p>
                <div>{{session('success')}}</div>
            </div>
        @endif
        @if (session('error'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                <p class="font-bold">Invalid Credential!</p>
                <div>{{session('success')}}</div>
            </div>
        @endif
        {{$slot}}
        @stack('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>