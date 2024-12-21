<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitCount - Community</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400,500,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }

        .CommunityPage {
            width: 100%;
            min-height: 100vh;
            position: relative;
            background: white;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            .CommunityPage {
                padding: 1rem;
            }
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

    <div class="CommunityPage">
        <!-- Hero Section -->
        <div class="relative w-full">
            <img class="w-full h-[300px] md:h-[558px] object-cover" src="{{ asset('images/image3.svg') }}"
                alt="komunitas" />
            <div class="absolute inset-0 bg-black/30"></div>

            <div class="absolute top-1/4 left-4 md:left-24 text-white">
                <h1 class="text-3xl md:text-5xl font-semibold mb-4 max-w-[499px]">
                    Dapatkan informasi untuk progress beratmu!
                </h1>
                <p class="text-sm md:text-base mb-6">
                    Temukan artikel dan inspirasi setiap bulannya di emailmu.
                </p>
                <a href="{{ route('check.auth') }}"
                    class="inline-block px-8 py-3 border-2 border-white rounded-full text-white hover:bg-white hover:text-black transition">
                    Bergabung
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="px-4 md:px-24 py-12">
            <h2 class="text-3xl md:text-5xl font-bold text-[#384031] mb-8">
                Yuk Bergabung ke Komunitas!
            </h2>
            <p class="text-lg md:text-xl mb-12 max-w-3xl">
                Bergabunglah dengan komunitas FitCount untuk mendapatkan dukungan dan motivasi dalam perjalanan
                kesehatan Anda.
            </p>

            <h2 class="text-3xl md:text-5xl font-bold text-[#384031] mb-8">
                Benefit
            </h2>
            <p class="text-lg md:text-xl mb-12 max-w-3xl">
                Dapatkan akses eksklusif ke berbagai fitur menarik seperti tracking BMI, event kesehatan terkini, dan
                tools perencanaan aktivitas.
            </p>

            <!-- Feature Cards -->
            <div class="grid md:grid-cols-1 gap-8 mb-12">
                <!-- BMI Card -->
                <div class="p-8 border-4 border-[#385723] rounded-2xl relative">
                    <div class="flex justify-between items-center">
                        <div class="max-w-[60%] md:max-w-[65%] lg:max-w-[70%]">
                            <h3 class="text-2xl md:text-3xl font-bold text-[#385723] mb-4">
                                Pencatatan Hasil BMI
                            </h3>
                            <p class="text-lg mb-4">
                                Pantau perkembangan BMI Anda dengan mudah dan teratur.
                            </p>
                        </div>
                        <div class="flex justify-end w-[30%] md:w-[25%] lg:w-[20%]">
                            <img src="{{ asset('images/vektor1.svg') }}" alt="BMI Vector"
                                class="w-20 md:w-28 lg:w-32 h-auto object-contain" />
                        </div>
                    </div>
                </div>

                <div class="p-8 border-4 border-[#385723] rounded-2xl relative">
                    <div class="flex justify-between items-center">
                        <div class="max-w-[60%] md:max-w-[65%] lg:max-w-[70%]">
                            <h3 class="text-2xl md:text-3xl font-bold text-[#385723] mb-4">
                                Update Event Kesehatan
                            </h3>
                            <p class="text-lg mb-4">
                                Jangan lewatkan berbagai event kesehatan menarik!
                            </p>
                        </div>
                        <div class="flex justify-end w-[30%] md:w-[25%] lg:w-[20%]">
                            <img src="{{ asset('images/vektor2.svg') }}" alt="BMI Vector"
                                class="w-20 md:w-28 lg:w-32 h-auto object-contain" />
                        </div>
                    </div>
                </div>

                <div class="p-8 border-4 border-[#385723] rounded-2xl relative">
                    <div class="flex justify-between items-center">
                        <div class="max-w-[60%] md:max-w-[65%] lg:max-w-[70%]">
                            <h3 class="text-2xl md:text-3xl font-bold text-[#385723] mb-4">
                                To Do List
                            </h3>
                            <p class="text-lg mb-4">
                                Kelola rutinitas sehat Anda dengan To Do List yang praktis.
                            </p>
                        </div>
                        <div class="flex justify-end w-[30%] md:w-[25%] lg:w-[20%]">
                            <img src="{{ asset('images/vektor2.svg') }}" alt="BMI Vector"
                                class="w-20 md:w-28 lg:w-32 h-auto object-contain" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
