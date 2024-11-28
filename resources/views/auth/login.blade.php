<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - FitCount</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400,500,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-header />
    <div class="min-h-screen bg-white">
        <div class="relative w-full h-[776px]">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/image1.svg') }}" class="w-full h-full object-cover" alt="Background">
                <div class="absolute inset-0 bg-gradient-radial from-[rgba(20,33,11,0.81)] to-[rgba(15,23,9,0.81)]">
                </div>
            </div>

            <!-- Login Content -->
            <div class="relative z-10 flex flex-col items-center pt-[139px]">
                <h1 class="text-[48px] font-bold text-white font-poppins text-center max-w-[638px]">
                    Selamat Datang Dikomunitas FitCount
                </h1>

                <p class="mt-[15px] text-[20px] font-medium text-white font-poppins">
                    silahkan Login ke Akun Anda
                </p>

                <!-- Login Form -->
                <form class="mt-[39px] w-[463px]">
                    <div class="relative mb-6">
                        <div class="relative">
                            <input type="email"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] pl-[74px] text-white placeholder-[#C7C7C7] backdrop-blur-[20px]"
                                placeholder="Email">
                            <!-- Mail Icon -->
                            <div class="absolute left-5 top-1/2 transform -translate-y-1/2">
                                <!-- Add your mail icon SVG here -->
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="password"
                            class="w-full h-[65px] bg-white/20 border-2 border-white rounded-[7px] pl-[74px] text-white placeholder-[#C7C7C7] backdrop-blur-[20px]"
                            placeholder="Kata Sandi">
                        <!-- Lock Icon -->
                        <div class="absolute left-5 top-1/2 transform -translate-y-1/2">
                            <!-- Add your lock icon SVG here -->
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <a href="#" class="text-[11px] font-bold text-white">Lupa Kata Sandi?</a>
                    </div>

                    <button type="submit"
                        class="mt-[30px] w-[238px] h-[44px] mx-auto block bg-[#BBE67A] rounded-[30px]">
                        <span class="text-[20px] font-medium text-[#385723] font-poppins">Masuk</span>
                    </button>

                    <p class="text-center mt-[9px] text-[13px] text-white font-poppins">
                        Tidak punya akun? <a href="{{ route('register') }}" class="font-bold">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
