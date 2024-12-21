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
        <div id="bmi-section"
            class="Frame7 mx-auto my-8 md:my-16 bg-[#385723] rounded-3xl p-4 md:p-8 max-w-4xl mx-4 md:mx-auto">
            <h2 class="text-2xl md:text-4xl font-bold text-[#FFF6CB] text-center mb-4 md:mb-8">Hitung BMI Anda</h2>
            <form action="{{ route('bmi.calculate') }}" method="POST" class="space-y-4 md:space-y-6">
                @csrf

                <!-- Activity Level -->
                <div>
                    <select name="activity_level" required
                        class="w-full bg-[#FEFAE0] rounded-lg p-3 md:p-4 text-sm md:text-base">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label class="mb-2 text-lg md:text-xl text-white">Usia</label>
                        <input type="number" name="age"
                            value="{{ Auth::check() ? Auth::user()->age : old('age') }}" required
                            class="w-full bg-[#FEFAE0] rounded-lg p-3 md:p-4 text-sm md:text-base"
                            placeholder="Usia kamu berapa?">
                        @error('age')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 text-lg md:text-xl text-white">Gender</label>
                        <select name="gender" required
                            class="w-full bg-[#FEFAE0] rounded-lg p-3 md:p-4 text-sm md:text-base">
                            <option value="" disabled {{ !Auth::user()->gender ? 'selected' : '' }}>Gender Kamu
                            </option>
                            <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>


                        @error('gender')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Weight and Height -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label class="mb-2 text-lg md:text-xl text-white">Berat Badan</label>
                        <div class="flex">
                            <input type="number" name="weight"
                                value="{{ Auth::check() ? Auth::user()->weight : old('weight') }}" step="1"
                                min="1" max="500" required
                                class="flex-1 bg-[#FEFAE0] rounded-l-lg p-3 md:p-4 text-sm md:text-base"
                                placeholder="Masukan berat badanmu ya">

                            <span class="bg-[#FEFAE0] p-3 md:p-4 rounded-r-lg font-bold text-sm md:text-base">Kg</span>
                        </div>
                        @error('weight')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 text-lg md:text-xl text-white">Tinggi Badan</label>
                        <div class="flex">
                            <input type="number" name="height"
                                value="{{ Auth::check() ? Auth::user()->height : old('height') }}" required
                                class="flex-1 bg-[#FEFAE0] rounded-l-lg p-3 md:p-4 text-sm md:text-base"
                                placeholder="Masukan tinggi badanmu ya">
                            <span class="bg-[#FEFAE0] p-3 md:p-4 rounded-r-lg font-bold text-sm md:text-base">CM</span>
                        </div>
                        @error('height')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                    class="w-full max-w-md mx-auto block bg-[rgba(254,250,224,0.15)] border-2 md:border-4 border-[#D4F3B7] text-[#F9EDB2] text-xl md:text-3xl font-semibold py-3 md:py-4 rounded-xl md:rounded-2xl mt-6 md:mt-8">
                    Hitung
                </button>
            </form>
        </div>
        {{-- End of Form --}}

        <!-- BMI Section -->
        <div id="tentang.section" class="relative w-full bg-[#001910] py-8 md:py-16">
            <!-- Gradient Background -->
            <div class="absolute inset-0 bg-[#001910] opacity-90"></div>

            <div class="container relative z-10 px-4 mx-auto">
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                    <!-- Left Section: Image -->
                    <div class="w-full md:w-1/2">
                        <img src="{{ asset('images/image16.svg') }}" alt="BMI Illustration"
                            class="w-full h-auto rounded-lg">
                    </div>

                    <!-- Right Section: Text Content -->
                    <div class="w-full md:w-1/2 max-w-lg">
                        <h2 class="mb-4 md:mb-6 text-4xl md:text-6xl font-bold leading-tight text-white">
                            BMI itu apasih?
                        </h2>
                        <p class="mb-6 md:mb-8 text-base md:text-lg leading-relaxed text-white">
                            The Body Mass Index (BMI) is a tool that is often used as a surrogate measure of body fat,
                            and can screen for obesity and associated health risks. It can be calculated using a BMI
                            calculator based on height and weight and results can be categorised into different classes,
                            ranging from underweight through to obesity class III.
                        </p>
                        <a href="#bmi-section"
                            class="inline-block bg-[#BBE67A] text-black text-base md:text-lg font-bold px-4 md:px-6 py-2 md:py-3 rounded-md shadow-md hover:bg-[#a5d95e] transition-colors">
                            Hitung Sekarang >>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of BMI Section -->

        <!-- Trending Section -->
        <div class="py-32">
            <h2 class="mb-8 text-4xl font-semibold text-center">Trending Hari ini</h2>
            <p class="mb-12 text-center">
                Temukan berita terkini secara realtime untuk mendukung pengetahuanmu
            </p>
            <!-- Trending Articles Carousel -->
            <div class="flex gap-8 px-8 pb-12 overflow-x-auto Group790">
                <!-- Article cards -->
                @foreach ($articles as $article)
                    <div class="flex-none w-[400px] transform transition-all duration-500 hover:scale-[1.03]">
                        <div
                            class="bg-[#F9EDB2] rounded-3xl overflow-hidden shadow-xl border-2 border-[#D4F3B7] h-full flex flex-col">
                            <div class="relative h-[250px] group">
                                <!-- News Image with overlay -->
                                <img src="{{ $article['urlToImage'] ?? asset('images/default-image.svg') }}"
                                    alt="{{ $article['title'] }}"
                                    class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#001910]/80 to-transparent"></div>

                                <!-- Source Badge - Positioned at top -->
                                <span
                                    class="absolute top-4 right-4 px-4 py-2 text-sm font-bold text-[#001910] bg-[#D4F3B7]/90 backdrop-blur-sm rounded-full">
                                    {{ $article['source']['name'] ?? 'Unknown Source' }}
                                </span>
                            </div>

                            <div class="flex flex-col justify-between flex-grow p-6 bg-white/95 backdrop-blur-sm">
                                <!-- News Title -->
                                <h3
                                    class="mb-4 text-xl font-semibold text-[#001910] line-clamp-2 hover:line-clamp-none transition-all duration-300">
                                    {{ $article['title'] }}
                                </h3>

                                <!-- Bottom Section with Date and Read More -->
                                <div class="flex items-center justify-between mt-4">
                                    <time class="text-sm font-medium text-[#94AB71]">
                                        {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y') }}
                                    </time>
                                    <a href="{{ $article['url'] }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 text-sm font-bold text-[#001910] bg-[#D4F3B7] rounded-full hover:bg-[#BBE67A] transition-colors duration-300">
                                        Read More →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



        <!-- Features Section -->
        <div class="Frame25"
            style="width: 100%; height: auto; position: relative; background: rgba(148, 171, 113, 0.66); padding: 16px; box-sizing: border-box;">
            <div class="grid w-full"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px; padding: 16px; box-sizing: border-box;">
                <!-- Feature Cards -->
                <div class="p-8 bg-white rounded-lg shadow-lg Frame21"
                    style="padding: 16px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="mb-8" style="margin-bottom: 16px; text-align: center;">
                        <img src="{{ asset('images/vektor1.svg') }}" alt="Notes"
                            style="width: 64px; height: 64px; margin: 0 auto;">
                    </div>
                    <h3
                        style="font-size: 1.5rem; font-weight: 600; color: #385723; margin-bottom: 16px; text-align: center;">
                        Pencatatan Hasil BMI</h3>
                    <p style="color: #385723; margin-bottom: 16px; text-align: center;">Catat hasil BMI kamu secara
                        rutin untuk melihat perkembanganmu</p>
                    <a href="{{ route('komunitas') }}"
                        style="display: block; background: #BBE67A; color: black; font-weight: bold; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none;">
                        Gabung Komunitas!
                    </a>
                </div>

                <div class="p-8 bg-white rounded-lg shadow-lg Frame26"
                    style="padding: 16px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="mb-8" style="margin-bottom: 16px; text-align: center;">
                        <img src="{{ asset('images/vektor2.svg') }}" alt="News"
                            style="width: 64px; height: 64px; margin: 0 auto;">
                    </div>
                    <h3
                        style="font-size: 1.5rem; font-weight: 600; color: #385723; margin-bottom: 16px; text-align: center;">
                        Berita Secara Real-Time</h3>
                    <p style="color: #385723; margin-bottom: 16px; text-align: center;">Mendapat informasi trending
                        secara realtime terkait dunia kesehatan</p>
                    <a href="{{ route('komunitas') }}"
                        style="display: block; background: #BBE67A; color: black; font-weight: bold; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none;">
                        Gabung Komunitas!
                    </a>
                </div>

                <div class="p-8 bg-white rounded-lg shadow-lg Frame27"
                    style="padding: 16px; background: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="mb-8" style="margin-bottom: 16px; text-align: center;">
                        <img src="{{ asset('images/vektor2.svg') }}" alt="Todo"
                            style="width: 64px; height: 64px; margin: 0 auto;">
                    </div>
                    <h3
                        style="font-size: 1.5rem; font-weight: 600; color: #385723; margin-bottom: 16px; text-align: center;">
                        To Do List Harian</h3>
                    <p style="color: #385723; margin-bottom: 16px; text-align: center;">Mencatat tugas harian untuk
                        mendukung produktifitas kamu menjalani hari</p>
                    <a href="{{ route('komunitas') }}"
                        style="display: block; background: #BBE67A; color: black; font-weight: bold; padding: 12px; border-radius: 8px; text-align: center; text-decoration: none;">
                        Gabung Komunitas!
                    </a>
                </div>
            </div>
        </div>
        <!-- End of Features Section -->


    </div>

    <x-footer />

    <script>
        // Hide flash messages after 3 seconds
        document.querySelectorAll('[id$="-message"]').forEach(el => {
            setTimeout(() => el.style.display = 'none', 3000);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Script Loaded");

            @if (Auth::check() && Auth::user()->gender)
                const userGender = @json(Auth::user()->gender);
                console.log("User Gender:", userGender);

                const genderSelect = document.querySelector('select[name="gender"]');
                if (genderSelect) {
                    setTimeout(() => {
                        genderSelect.value = userGender;
                        console.log("Dropdown updated to:", genderSelect.value);
                    }, 0); // Delaying slightly in case the DOM updates asynchronously
                } else {
                    console.log("Dropdown element not found");
                }
            @else
                console.log("User not authenticated or gender not set");
            @endif
        });
    </script>



</body>

</html>
