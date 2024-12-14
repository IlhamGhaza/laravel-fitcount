<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitCount - Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400,500,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <x-header />

    <!-- Flash Messages -->
    @if (session('logout'))
        <div id="logout-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#BBE67A] text-[#385723] px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('logout') }}</span>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div id="success-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#BBE67A] text-[#385723] px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#FF2D20] text-[#385723] px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="w-full min-h-screen bg-white Homepage">
        <!-- Hero Section -->
        <div class="Frame15 w-full h-[420px] relative bg-[#385723] overflow-hidden">
            <img src="{{ asset('images/image11.svg') }}" alt="Hero" class="object-cover w-full h-full opacity-50">
        </div>

        <!-- CTA Section -->
        <div class="px-6 mt-16 text-center">
            <h1 class="mb-8 text-5xl font-bold font-poppins">Hitung kalorimu untuk memulai sehatmu</h1>
            <a href="{{ route('bmi.form') }}"
                class="inline-block bg-[#BBE67A] text-black font-bold px-12 py-4 rounded-lg shadow-lg">
                Hitung Sekarang >>
            </a>
        </div>

        <!-- Feature Images -->
        <div class="flex justify-center gap-6 px-6 mt-8">
            <div class="bg-[#94AB71] rounded-lg overflow-hidden shadow-md">
                <img src="{{ asset('images/image9.svg') }}" alt="Feature 1" class="object-cover w-full h-56">
            </div>
            <div class="bg-[#BBE67A] rounded-lg overflow-hidden shadow-md">
                <img src="{{ asset('images/image8.svg') }}" alt="Feature 2" class="object-cover w-full h-56">
            </div>
            <div class="bg-[#384031] rounded-lg overflow-hidden shadow-md">
                <img src="{{ asset('images/image2.svg') }}" alt="Feature 3" class="object-cover w-full h-56">
            </div>
        </div>

        <!-- Community Banner -->
        <div class="relative mt-16 Frame19">
            <img src="{{ asset('images/image12.svg') }}" alt="Community" class="w-full h-[343px] object-cover">
            <div class="absolute inset-0 bg-[rgba(0,25,16,0.50)] flex items-center justify-center">
                <div class="text-center text-white">
                    <h2 class="mb-4 text-4xl font-bold">Catat perkembangan BMI mu bersama komunitas kami!</h2>
                    <a href="{{ route('komunitas') }}"
                        class="inline-block bg-[#BBE67A] text-black font-bold px-12 py-4 rounded-lg shadow-md">
                        Gabung Komunitas!
                    </a>
                </div>
            </div>
        </div>

        <!-- BMI Calculator Form -->
        <div id="bmi-section" class="Frame7 mx-auto my-16 bg-[#385723] rounded-3xl p-8 max-w-4xl">
            <h2 class="text-4xl font-bold text-[#FFF6CB] text-center mb-8">Hitung BMI Anda</h2>
            <form action="{{ route('bmi.calculate') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Activity Level -->
                <div>
                    <select name="activity_level" required class="w-full bg-[#FEFAE0] rounded-lg p-4">
                        <option value="">Aktivitas fisik kamu termasuk yang mana?</option>
                        <option value="low" {{ old('activity_level') == 'low' ? 'selected' : '' }}>Rendah</option>
                        <option value="medium" {{ old('activity_level') == 'medium' ? 'selected' : '' }}>Sedang
                        </option>
                        <option value="high" {{ old('activity_level') == 'high' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                    @error('activity_level')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Age and Gender -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="mb-2 text-xl text-white">Usia</label>
                        <input type="number" name="age" value="{{ old('age') }}" required
                            class="w-full bg-[#FEFAE0] rounded-lg p-4" placeholder="Usia kamu berapa?">
                        @error('age')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 text-xl text-white">Gender</label>
                        <select name="gender" required class="w-full bg-[#FEFAE0] rounded-lg p-4">
                            <option value="">Gender Kamu</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Weight and Height -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="mb-2 text-xl text-white">Berat Badan</label>
                        <div class="flex">
                            <input type="number" name="weight" value="{{ old('weight') }}" required
                                class="flex-1 bg-[#FEFAE0] rounded-l-lg p-4" placeholder="Masukan berat badanmu ya">
                            <span class="bg-[#FEFAE0] p-4 rounded-r-lg font-bold">Kg</span>
                        </div>
                        @error('weight')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 text-xl text-white">Tinggi Badan</label>
                        <div class="flex">
                            <input type="number" name="height" value="{{ old('height') }}" required
                                class="flex-1 bg-[#FEFAE0] rounded-l-lg p-4" placeholder="Masukan tinggi badanmu ya">
                            <span class="bg-[#FEFAE0] p-4 rounded-r-lg font-bold">CM</span>
                        </div>
                        @error('height')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                    class="w-full max-w-md mx-auto block bg-[rgba(254,250,224,0.15)] border-4 border-[#D4F3B7] text-[#F9EDB2] text-3xl font-semibold py-4 rounded-2xl mt-8">
                    Hitung
                </button>
            </form>
        </div>


        <!-- BMI Section -->
        <div id="tentang.section" class="relative w-full bg-[#001910] py-16">

            <!-- Gradient Background -->
            <div class="absolute inset-0 bg-[#001910] opacity-90"></div>

            <div class="container relative z-10 flex items-center mx-auto">
                <!-- Left Section: Image -->
                <div class="flex-1">
                    <img src="{{ asset('images/image16.svg') }}" alt="BMI Illustration"
                        class="w-full h-auto rounded-lg">
                </div>

                <!-- Right Section: Text Content -->
                <div class="flex-1 max-w-lg ml-12">
                    <h2 class="mb-6 text-6xl font-bold leading-snug text-white">BMI itu apasih?</h2>
                    <p class="mb-8 text-lg leading-relaxed text-white">
                        The Body Mass Index (BMI) is a tool that is often used as a surrogate measure of body fat,
                        and can screen for obesity and associated health risks. It can be calculated using a BMI
                        calculator
                        based on height and weight and results can be categorised into different classes, ranging from
                        underweight through to obesity class III.
                    </p>
                    <a href="#bmi-section"
                        class="inline-block bg-[#BBE67A] text-black text-lg font-bold px-6 py-3 rounded-md shadow-md">
                        Hitung Sekarang >>
                    </a>
                </div>
            </div>
        </div>



        <!-- Trending Section -->
        <div class="py-32">
            <h2 class="mb-8 text-4xl font-semibold text-center">Trending Hari ini</h2>
            <p class="mb-12 text-center">
                Temukan berita terkini secara realtime untuk mendukung pengetahuanmu
            </p>

            <!-- Trending Articles Carousel -->
            <div class="flex gap-6 px-6 overflow-x-auto Group790">
                <!-- Article cards -->
                @for ($i = 1; $i <= 3; $i++)
                    <div class="Frame20 flex-none w-[1010px] bg-[#F9EDB2] rounded-[40px] overflow-hidden shadow-lg">
                        <div class="relative h-[350px]">
                            <img src="{{ asset('images/image5-' . $i . '.svg') }}" alt="Article {{ $i }}"
                                class="object-cover w-full h-full">
                        </div>
                        <div class="p-6 bg-white">
                            <h3 class="mb-4 text-2xl font-medium">
                                Kurangnya Aktivitas fisik menjadi pemicu utama obesitas dikalangan remaja
                            </h3>
                            <span class="text-[#C5C4C4] font-bold">nationalgeographic.grid.id</span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>



        <!-- Features Section -->
        <div class="Frame25"
            style="width: 100%; height: 500px; position: relative; background: rgba(148, 171, 113, 0.66)">
            <div class="grid w-full grid-cols-3 gap-8 px-6 py-16">
                <!-- Feature Cards -->
                <div class="p-8 bg-white rounded-lg shadow-lg Frame21">
                    <div class="mb-8">
                        <img src="{{ asset('images/vektor1.svg') }}" alt="Notes" class="w-16 h-16 mx-auto">
                    </div>
                    <h3 class="text-2xl font-semibold text-[#385723] mb-4">Pencatatan Hasil BMI</h3>
                    <p class="text-[#385723] mb-8">Catat hasil BMI kamu secara rutin untuk melihat perkembanganmu</p>
                    <a href="{{ route('komunitas') }}"
                        class="block bg-[#BBE67A] text-black font-bold px-6 py-3 rounded-lg text-center">
                        Gabung Komunitas!
                    </a>
                </div>

                <div class="p-8 bg-white rounded-lg shadow-lg Frame26">
                    <div class="mb-8">
                        <img src="{{ asset('images/vektor2.svg') }}" alt="News" class="w-16 h-16 mx-auto">
                    </div>
                    <h3 class="text-2xl font-semibold text-[#385723] mb-4">Berita Secara Real-Time</h3>
                    <p class="text-[#385723] mb-8">Mendapat informasi trending secara realtime terkait dunia kesehatan
                    </p>
                    <a href="{{ route('komunitas') }}"
                        class="block bg-[#BBE67A] text-black font-bold px-6 py-3 rounded-lg text-center">
                        Gabung Komunitas!
                    </a>
                </div>

                <div class="p-8 bg-white rounded-lg shadow-lg Frame27">
                    <div class="mb-8">
                        <img src="{{ asset('images/vektor2.svg') }}" alt="Todo" class="w-16 h-16 mx-auto">
                    </div>
                    <h3 class="text-2xl font-semibold text-[#385723] mb-4">To Do List Harian</h3>
                    <p class="text-[#385723] mb-8">Mencatat tugas harian untuk mendukung produktifitas kamu menjalani
                        hari</p>
                    <a href="{{ route('komunitas') }}"
                        class="block bg-[#BBE67A] text-black font-bold px-6 py-3 rounded-lg text-center">
                        Gabung Komunitas!
                    </a>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Hide flash messages after 3 seconds
        document.querySelectorAll('[id$="-message"]').forEach(el => {
            setTimeout(() => el.style.display = 'none', 3000);
        });
    </script>
</body>

</html>
