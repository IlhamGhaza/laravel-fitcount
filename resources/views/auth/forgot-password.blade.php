<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - FitCount</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400,500,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <x-header />
    <div class="min-h-screen bg-white">
        <div class="relative w-full h-[776px]">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/image1.svg') }}" class="object-cover w-full h-full" alt="Background">
                <div class="absolute inset-0 bg-gradient-radial from-[rgba(20,33,11,0.81)] to-[rgba(15,23,9,0.81)]">
                </div>
            </div>

            <!-- Forgot Password Content -->
            <div class="relative z-10 flex flex-col items-center pt-[139px]">
                <h1 class="text-[48px] font-bold text-white font-poppins text-center max-w-[638px]">
                    Lupa Kata Sandi?
                </h1>

                <p class="mt-[15px] text-[20px] font-medium text-white font-poppins text-center max-w-[500px]">
                    Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda
                </p>

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="bg-red-600 text-white p-4 mb-4 rounded-lg w-full max-w-[463px]">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('status'))
                    <div class="bg-green-600 text-white p-4 mb-4 rounded-lg w-full max-w-[463px]">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Forgot Password Form -->
                <form method="POST" action="{{ route('password.email') }}" class="mt-[39px] w-[463px]">
                    @csrf

                    <div class="relative mb-6">
                        <div class="relative">
                            <input type="email" name="email"
                                   class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] pl-[74px] text-white placeholder-[#C7C7C7] backdrop-blur-[20px]"
                                   placeholder="Email" value="{{ old('email') }}" required autofocus>
                            <!-- Mail Icon (Optional) -->
                            <div class="absolute transform -translate-y-1/2 left-5 top-1/2">
                                <!-- Add your mail icon SVG here -->
                            </div>
                        </div>
                        @error('email')
                            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                            class="mt-[30px] w-[238px] h-[44px] mx-auto block bg-[#BBE67A] rounded-[30px]">
                        <span class="text-[20px] font-medium text-[#385723] font-poppins">Kirim Link</span>
                    </button>

                    <p class="text-center mt-[9px] text-[13px] text-white font-poppins">
                        Kembali ke <a href="{{ route('login') }}" class="font-bold">Halaman Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
