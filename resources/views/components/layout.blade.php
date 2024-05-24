<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>pdf hosting</title>
</head>
<body>
<nav class="bg-gradient-to-r from-thiel to-thiel--end pt-1">
    <div class="container mx-auto">
        <div class=" flex flex-row justify-between">
            <div class="flex-col whitespace-nowrap py-3">
                <img class="inline-flex px-2 relative align-baseline"
                     src="/dist/img/folder-pink.png"/>
                <h1 class="text-5xl text-white relative inline-flex align-baseline"><a
                        href="{{ route('login') }}">pdf hosting</a></h1>
            </div>
            @auth
                <div class="flex flex-col whitespace-nowrap pt-5">
                        <span class="inline-flex text-white">
                        <a id="entry-link--main" href="{{ route('entries') }}"
                           class="text-xl px-0.5 mr-2 hover:border-pink border-transparent border-b-2 focus:text-pink focus:border-white">Einträge</a>

                    <a id="upload-link--main" href="{{ route('upload.create') }}"
                       class="text-xl px-0.5 hover:border-pink border-transparent border-b-2 focus:text-pink focus:border-white">Upload</a>
                    </span>
                </div>
            @endauth

            <div class="flex flex-col text-sm pt-2">
                @auth
                    <div class="my-auto text-white">
                        <img class="h-[30px] inline mx-1" src="/dist/img/pink_robot_avatar.png"
                             title="eingeloggt als"
                             alt="avatar">{{ auth()->user()->getUsername() }}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit">
                                <img class="h-[26px] inline mx-1" src="/dist/img/svg/logout-icon.svg"
                                     title="Logout"
                                     alt="Logout Icon">
                            </button>
                        </form>
                    </div>
                @else
                    <div class="my-auto text-white">
                        <a id="login-link--main" href="{{ route('login') }}"
                           class="mr-1 text-lg px-0.5 text-white border-transparent border-b-2 hover:text-pink focus:border-pink">Login</a>
                        <a id="register-link--main" href="{{ route('register.create') }}"
                           class="mr-1 text-lg px-0.5 text-white border-transparent border-b-2 hover:text-pink focus:border-pink">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
<x-flash></x-flash>

<main class="container mx-auto mt-4">

    {{ $slot }}

</main>
<footer></footer>
</body>
