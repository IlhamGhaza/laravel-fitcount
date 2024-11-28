<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account - FitCount</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-header />

    <div class="min-h-screen bg-white">
        <!-- Profile Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-[#385723] rounded-[50px] shadow-lg p-8">
                <div class="flex items-center gap-8">
                    <div class="w-[183px] h-[183px]">
                        <img class="w-full h-full rounded-full" src="https://via.placeholder.com/183x183"
                            alt="Profile Avatar" />
                    </div>
                    <div class="text-white">
                        <h1 class="text-4xl font-bold">Ilham Ghazali, <span class="text-2xl font-normal">72 Tahun</span>
                        </h1>
                        <p class="mt-4 text-xl font-light">Ilhamimoet123@gmail.com - 195 cm, 42 Kg</p>
                    </div>
                </div>
            </div>

            <!-- BMI Score Cards -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#A5B987] rounded-[20px] p-8 shadow-lg">
                    <h2 class="text-4xl font-bold text-white text-center">Skor BMI</h2>
                    <div class="border-t border-white my-4"></div>
                    <p class="text-8xl font-bold text-white text-center">15,62</p>
                </div>

                <div class="bg-[#385723] rounded-[20px] p-8 shadow-lg">
                    <h2 class="text-4xl font-bold text-white text-center">Kategori BMI</h2>
                    <div class="border-t border-white my-4"></div>
                    <p class="text-6xl font-bold text-white text-center">Kurang Ideal</p>
                </div>
            </div>

            <!-- BMI History -->
            <div class="mt-12 bg-[#F6F6F6] rounded-lg shadow-lg p-8">
                <div class="flex justify-between items-center">
                    <h2 class="text-4xl font-semibold">Histori Skor BMI</h2>
                    <a href="#" class="text-[#385723] text-xl font-semibold">Lihat Semua ></a>
                </div>
                <!-- Add your BMI history graph here -->
            </div>

            <!-- To Do List -->
            <div class="mt-12 bg-[#385723]/20 py-12">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-4xl font-bold">To do list</h2>
                        <a href="#" class="text-[#385723] text-xl font-semibold">Lihat Semua ></a>
                    </div>
                    <!-- Add your todo list items here -->
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
