<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FitCount - BMI Result</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400,500,700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body style="font-family: Poppins, sans-serif; margin: 0; padding: 0; background: #384031;">
    <x-header />

    <!-- Message Card -->
    @if (session('successSaved'))
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl p-8 mx-auto bg-white shadow-lg rounded-2xl">
                <!-- Success Icon -->
                <div class="flex justify-center mb-8">
                    <div class="w-32 h-32 bg-[#A5B987] rounded-full flex items-center justify-center shadow-md">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-medium text-black md:text-3xl font-poppins">
                        Yeay, Skor hasil BMI anda saat ini sudah disimpan yuk, cek perkembangan mu!
                    </h2>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <button onclick="this.closest('.fixed').style.display='none'"
                        class="px-8 py-3 font-semibold tracking-wide transition-colors border border-black rounded-md shadow hover:bg-gray-100">
                        Lewati
                    </button>

                    <button onclick="window.location.href='{{ route('progress') }}'"
                        class="px-8 py-3 bg-[#94AB71] border border-[#F9EDB2] text-white rounded-md shadow hover:bg-[#7c9158] transition-colors font-semibold tracking-wide">
                        Lihat Grafik
                    </button>
                </div>
            </div>
        </div>
    @endif


    {{-- error saved --}}
    @if (session('errorSaved'))
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl p-8 mx-auto bg-white shadow-lg rounded-2xl">
                <!-- Error Icon -->
                <div class="flex justify-center mb-8">
                    <div class="w-32 h-32 bg-[#FF2D20] rounded-full flex items-center justify-center shadow-md">
                        <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Success Message -->
                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-medium text-black md:text-3xl font-poppins">
                        Yah, Skor hasil BMI kamu belum bisa disimpan nih
                        coba cek lain waktu ya
                    </h2>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <button onclick="this.closest('.fixed').style.display='none'"
                        class="px-8 py-3 font-semibold tracking-wide transition-colors border border-black rounded-md shadow hover:bg-gray-100">
                        Lewati
                    </button>

                    <button onclick="window.location.href='{{ route('progress') }}'"
                        class="px-8 py-3 bg-[#94AB71] border border-[#F9EDB2] text-white rounded-md shadow hover:bg-[#7c9158] transition-colors font-semibold tracking-wide">
                        Lihat Grafik
                    </button>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bmiScore = {{ $bmiScore ?? 0 }};
            const indicator = document.getElementById("bmi-indicator");
            const container = document.querySelector(
            ".FrameBmiParameter"); // Ubah selector ini sesuai dengan container yang benar

            if (!indicator || !container) {
                console.error("Indicator or container not found");
                return;
            }

            const ranges = [{
                    min: 0,
                    max: 18.5,
                    position: 0
                },
                {
                    min: 18.5,
                    max: 24.9,
                    position: 16.66
                },
                {
                    min: 25,
                    max: 29.9,
                    position: 33.32
                },
                {
                    min: 30,
                    max: 34.9,
                    position: 49.98
                },
                {
                    min: 35,
                    max: 39.9,
                    position: 66.64
                },
                {
                    min: 40,
                    max: 100,
                    position: 83.3
                }
            ];

            const range = ranges.find((r) => bmiScore >= r.min && bmiScore <= r.max);
            if (range) {
                const containerWidth = container.offsetWidth;
                const position = (range.position * containerWidth) / 100;
                indicator.style.left = `${position}px`;
                console.log(`BMI Score: ${bmiScore}, Position: ${position}px`);
            } else {
                console.log(`No range found for BMI score: ${bmiScore}`);
            }
        });
    </script>

    <!-- Main Content Section -->
    <div style="width: 100%; height: auto; padding: 40px 0; background: #384031;">
        <!-- Main Card -->
        <div
            style="width: 90%; max-width: 1234px; margin: 0 auto; background: #D4F3B7; border-radius: 30px; position: relative; padding: 40px 20px;">
            <!-- BMI Score and Category Cards Container -->
            <div
                style="display: flex; justify-content: space-between; max-width: 900px; margin: 20px auto; flex-wrap: wrap; gap: 20px;">
                <!-- BMI Score Card -->
                <div
                    style="flex: 1; min-width: 300px; max-width: 400px; background: #FEFAE0; border-radius: 25px; padding: 20px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <h3 style="font-size: 24px; margin: 0 0 15px 0;">Skor BMI kamu</h3>
                    <p style="font-size: 36px; font-weight: bold; margin: 0;">{{ $bmiScore ?? 'N/A' }}</p>
                </div>

                <!-- Category Card -->
                <div
                    style="flex: 1; min-width: 300px; max-width: 400px; background: #FEFAE0; border-radius: 25px; padding: 20px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <h3 style="font-size: 24px; margin: 0 0 15px 0;">Kategori</h3>
                    <p style="font-size: 40px; font-weight: 400;">{{ $bmiCategory ?? 'Berat Badan Kurang' }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; justify-content: center; gap: 20px; margin-top: 40px;">
                <button onclick="window.location.href='{{ route('home') }}#bmi-section'"
                    style="padding: 12px 30px; background: #BBE67A; border: none; border-radius: 10px; font-size: 18px; font-weight: 600; cursor: pointer;">
                    Ulangi Perhitungan
                </button>
                <form action="{{ route('save-bmi') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="padding: 12px 30px; background: #BBE67A; border: none; border-radius: 10px; font-size: 18px; font-weight: 600; cursor: pointer;">
                        Simpan
                    </button>
                </form>
            </div>
        </div>

        <!-- BMI Details Section -->
        <div style="width: 100%; background: white; padding: 50px 0; margin-top: 80px;">
            <h2 style="text-align: center; font-size: 36px; font-weight: bold; margin-bottom: 40px; color: black;">
                Hasil BMI Anda: {{ $bmiCategory ?? 'N/A' }}
            </h2>

            <!-- BMI Scale Container -->
            <div style="width: 100%; max-width: 1000px; margin: 0 auto 30px auto; position: relative;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <div
                        style="width: 16.66%; height: 10px; background: linear-gradient(90deg, #7BABD3 0%, #7BABD3 100%);">
                    </div>
                    <div
                        style="width: 16.66%; height: 10px; background: linear-gradient(90deg, #57BC6E 0%, #57BC6E 100%);">
                    </div>
                    <div
                        style="width: 16.66%; height: 10px; background: linear-gradient(90deg, #EADF45 0%, #EADF45 100%);">
                    </div>
                    <div
                        style="width: 16.66%; height: 10px; background: linear-gradient(90deg, #F5833D 0%, #F5833D 100%);">
                    </div>
                    <div
                        style="width: 16.66%; height: 10px; background: linear-gradient(90deg, #F25E5E 0%, #F25E5E 100%);">
                    </div>
                    <div
                        style="width: 16.66%; height: 10px; background: linear-gradient(90deg, #000000 0%, #000000 100%);">
                    </div>
                </div>
                <!-- BMI Indicator -->
                <div id="bmi-indicator"
                    style="width: 3px; height: 20px; background-color: black; position: absolute; top: -5px; transform: translateX(-50%);">
                </div>

                <!-- Scale Labels -->
                <div style="display: flex; justify-content: space-between; padding: 0 10px;">
                    <span style="width: 16.66%; text-align: center; font-size: 14px;">Underweight</span>
                    <span style="width: 16.66%; text-align: center; font-size: 14px;">Normal weight</span>
                    <span style="width: 16.66%; text-align: center; font-size: 14px;">Overweight</span>
                    <span style="width: 16.66%; text-align: center; font-size: 14px;">Obese 1</span>
                    <span style="width: 16.66%; text-align: center; font-size: 14px;">Obese 2</span>
                    <span style="width: 16.66%; text-align: center; font-size: 14px;">Obese 3</span>
                </div>
            </div>

            <!-- Message -->
            <p style="text-align: center; font-size: 16px; max-width: 800px; margin: 30px auto; line-height: 1.5;">
                {{ $recommendation ?? 'N/A' }}
            </p>
        </div>

        <!-- BMI Range Section -->
        <div class="FrameBmiParameter"
            style="width: 100%; max-width: 1362px; height: 736px; position: relative; margin: 0 auto; padding-top: 20px; margin-bottom: 80px; margin-top: 80px;">
            <img src="{{ asset('images/indexbmi.svg') }}" alt="BMI Index Chart"
                style="width: 100%; height: 100%; object-fit: contain;">
        </div>


    </div>
    <x-footer />
</body>

</html>
