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
</head>

<body>
    <x-header />

    <div class="min-h-screen bg-white">
        <!-- Profile Section -->
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-[#385723] rounded-[50px] shadow-lg p-8">
                <div class="flex items-center gap-8">
                    <div class="w-[183px] h-[183px]">
                        <img class="w-full h-full rounded-full" src="{{ Auth::user()->avatar }}" alt="Profile Avatar" />
                    </div>
                    <div class="text-white">
                        <div class="flex items-center gap-4">
                            <h1 class="text-4xl font-bold">{{ Auth::user()->name }}, </h1>
                            <p class="mt-4 text-xl font-light">{{ Auth::user()->age }} years old</p>
                        </div>
                        <p class="mt-4 text-xl font-light">{{ Auth::user()->email }} - {{ Auth::user()->height }} cm,
                            {{ Auth::user()->weight }} Kg</p>

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
                        <a href="#" class="text-[#385723] text-xl font-semibold">Lihat Semua ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
