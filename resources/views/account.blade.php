<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account - FitCount</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    @if (session('success'))
        <div id="success-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#BBE67A] text-[#385723] px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#FF2D20] text-white px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <script>
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.style.display = 'none';
            }
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000);
    </script>

    <x-header />
    <div class="min-h-screen bg-white">

        <div class="min-h-screen bg-white">
            <!-- Profile Section -->
            <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-[#385723] rounded-[50px] shadow-lg p-8">
                    <div class="flex items-center gap-8">
                        <div class="w-[183px] h-[183px]">
                            @if (Auth::user()->avatar)
                                <img class="w-full h-full rounded-full"
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Avatar" />
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-full h-full text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            @endif
                        </div>
                        <div class="text-white">
                            <div class="flex items-center gap-4">
                                <h1 class="text-4xl font-bold">{{ Auth::user()->name }}, </h1>
                                <p class="mt-4 text-xl font-light">{{ Auth::user()->age }} years old</p>
                            </div>
                            <p class="mt-4 text-xl font-light">{{ Auth::user()->email }} - {{ Auth::user()->height }}
                                cm,
                                {{ Auth::user()->weight }} Kg
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex gap-4 mt-4">
                                <a href="{{ route('users.edit') }}"
                                    class="inline-flex items-center px-4 py-2 bg-[#BBE67A] rounded-[30px] font-medium text-[#385723] hover:bg-[#a5cc69] transition-colors">
                                    <span class="text-lg">Edit Profile</span>
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-[30px] font-medium hover:bg-red-600 transition-colors">
                                        <span class="text-lg">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BMI Score Cards -->
                <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2">
                    <div class="bg-[#A5B987] rounded-[20px] p-8 shadow-lg">
                        <h2 class="text-4xl font-bold text-center text-white">Skor BMI</h2>
                        <div class="my-4 border-t border-white"></div>
                        <p class="font-bold text-center text-white text-8xl">15,62</p>
                    </div>

                    <div class="bg-[#385723] rounded-[20px] p-8 shadow-lg">
                        <h2 class="text-4xl font-bold text-center text-white">Kategori BMI</h2>
                        <div class="my-4 border-t border-white"></div>
                        <p class="text-6xl font-bold text-center text-white">Kurang Ideal</p>
                    </div>
                </div>

                <!-- BMI History -->
                <div class="mt-12 bg-[#F6F6F6] rounded-lg shadow-lg p-8">
                    <div class="flex items-center justify-between">
                        <h2 class="text-4xl font-semibold">Histori Skor BMI</h2>
                        <a href="#" class="text-[#385723] text-xl font-semibold">Lihat Semua ></a>
                    </div>
                </div>

                <!-- To Do List -->
                <div class="mt-12 bg-[#385723]/20 py-12">
                    <div class="px-4 mx-auto max-w-7xl">
                        <div class="flex items-center justify-between">
                            <h2 class="text-4xl font-bold">To do list</h2>
                            <a href="{{ route('todo') }}" class="text-[#385723] text-xl font-semibold">Lihat Semua>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-footer />
</body>

</html>
