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

<body style="font-family: Poppins, sans-serif; color: black;">
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


    {{-- status success --}}
    @if (session('success'))
        <div id="success-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#BBE67A] text-[#385723] px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('success') }}</span>
            </div>
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
        </script>
    @endif
    {{-- status error --}}
    @if (session('error'))
        <div id="error-message" class="fixed z-50 top-4 right-4">
            <div class="bg-[#FF2D20] text-[#385723] px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-lg font-medium">{{ session('error') }}</span>
            </div>
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('error-message').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bmiScore = {{ $bmiScore ?? 0 }}; // Get BMI score from controller
            const indicator = document.getElementById("bmi-indicator");
            const parameterContainer = document.querySelector(".Parameter");

            const ranges = [{
                    min: 0,
                    max: 18.5,
                    position: 0
                }, // Underweight
                {
                    min: 18.5,
                    max: 24.9,
                    position: 1
                }, // Normal weight
                {
                    min: 25,
                    max: 29.9,
                    position: 2
                }, // Overweight
                {
                    min: 30,
                    max: 100,
                    position: 3
                }, // Obese
            ];

            const range = ranges.find((r) => bmiScore >= r.min && bmiScore <= r.max);
            if (range) {
                const segmentWidth = parameterContainer.offsetWidth / ranges.length;
                indicator.style.left = `${range.position * segmentWidth + segmentWidth / 2 - 5}px`;
            }
        });
    </script>

    {{-- design --}}
    <!-- Main Content Section -->
    <div style="width: 100vw; margin: auto; position: relative; background: #384031;">
        <div
            style="width: 1234px; height: 660px; margin: 40px auto; background: #D4F3B7; border-radius: 30px; box-shadow: 0px 4px 4px #F9EDB2; position: relative; overflow: hidden;">
            <!-- Skor BMI -->
            <div
                style="width: 400px; height: 250px; background: #FEFAE0; box-shadow: 0px 7px 4px rgba(0, 0, 0, 0.25); border-radius: 70px; text-align: center; position: absolute; top: 50px; left: 80px;">
                <p style="margin: 20px 0; font-size: 40px; font-weight: 500;">Skor BMI kamu</p>
                <p style="font-size: 48px; font-weight: 400;">{{ $bmiScore ?? '15.62' }}</p>
            </div>

            <!-- Kategori BMI -->
            <div
                style="width: 400px; height: 250px; background: #FEFAE0; box-shadow: 0px 7px 4px rgba(0, 0, 0, 0.25); border-radius: 70px; text-align: center; position: absolute; top: 50px; right: 80px;">
                <p style="margin: 20px 0; font-size: 40px; font-weight: 500;">Kategori</p>
                <p style="font-size: 40px; font-weight: 400;">{{ $bmiCategory ?? 'Berat Badan Kurang' }}</p>
            </div>

            <!-- Buttons -->
            <div
                style="position: absolute; bottom: 30px; width: 100%; display: flex; justify-content: center; gap: 20px;">
                <button onclick="window.location.href='{{ route('bmi.form') }}'"
                    style="padding: 15px 30px; background: #BBE67A; color: black; font-size: 24px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer;">Ulangi
                    Perhitungan</button>

                <form action="{{ route('save-bmi') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit"
                        style="padding: 15px 30px; background: #BBE67A; color: black; font-size: 24px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer;">Simpan</button>
                </form>
            </div>
        </div>

        <!-- BMI Details Section -->
        <div class="FrameBmiParameter" style="width: 1440px; height: 776px; position: relative;">
            <!-- Background -->
            <div class="Rectangle2" style="width: 100vw; height: 776px; position: absolute; background: white;"></div>

            <!-- Judul Hasil BMI -->
            <div class="HasilBmiAnda"
                style="width: 100%; text-align: center; color: black; font-size: 48px; font-family: Poppins; font-weight: 700; position: absolute; top: 50px;">
                Hasil BMI Anda: <span id="bmi-category">{{ $bmiCategory ?? 'N/A' }}</span>
            </div>

            <!-- Parameter Garis BMI -->
            <div class="Parameter"
                style="width: 80%; height: 142px; margin: auto; position: absolute; top: 300px; display: flex; justify-content: space-between;">
                <!-- Grup Garis -->
                <div style="width: 25%; display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 100%; height: 10px; background-color: #7BABD3;"></div>
                    <p style="font-size: 14px; font-family: Poppins; margin-top: 5px; text-align: center;">Underweight
                    </p>
                </div>
                <div style="width: 25%; display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 100%; height: 10px; background-color: #57BC6E;"></div>
                    <p style="font-size: 14px; font-family: Poppins; margin-top: 5px; text-align: center;">Normal weight
                    </p>
                </div>
                <div style="width: 25%; display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 100%; height: 10px; background-color: #EADF45;"></div>
                    <p style="font-size: 14px; font-family: Poppins; margin-top: 5px; text-align: center;">Overweight
                    </p>
                </div>
                <div style="width: 25%; display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 100%; height: 10px; background-color: #F5833D;"></div>
                    <p style="font-size: 14px; font-family: Poppins; margin-top: 5px; text-align: center;">Obese</p>
                </div>
            </div>


            <!-- Indikator BMI -->
            <div id="bmi-indicator"
                style="width: 10px; height: 142px; background-color: black; position: absolute; top: 300px; left: calc(50% - 5px);">
            </div>
        </div>


        <!-- BMI Range Section -->
        <div class="FrameBmiParameter"
            style="width: 100%; max-width: 1362px; height: 736px; position: relative; margin: 0 auto; padding-top: 20px; margin-bottom: 80px;">
            <!-- Background Container -->
            <div class="Rectangle2"
                style="width: 100%; height: 736px; position: absolute; background: #385723; border-radius: 30px; margin-top: 20px;">
                <!-- Gradient Bar -->
                <div class="gradient-bar"
                    style="width: 265px; height: 580px; margin: 78px 172px; position: relative; background: linear-gradient(180deg, #7BABD3 3%, #57BC6E 20%, #EADF45 40%, #F5833D 60%, #F25E5E 80%, black 94%); border-radius: 10px;">
                </div>

                <!-- BMI Ranges -->
                <div class="bmi-ranges"
                    style="position: absolute; left: 172px; top: 78px; width: 265px; color: white; font-size: 32px; font-family: Poppins; font-weight: 500; text-align: center">
                    <div style="margin-bottom: 44px">
                        < 18.5</div>
                            <div style="margin-bottom: 44px">18.5 - 24.9</div>
                            <div style="margin-bottom: 44px">25 - 29.9</div>
                            <div style="margin-bottom: 44px">30 - 34.9</div>
                            <div style="margin-bottom: 44px">35 - 39.9</div>
                            <div>>= 40</div>
                    </div>

                    <!-- BMI Categories -->
                    <div class="bmi-categories"
                        style="position: absolute; left: 479px; top: 78px; width: 450px; color: white; font-size: 36px; font-family: Poppins; font-weight: 500">
                        <div style="margin-bottom: 44px">Berat Badan Kurang</div>
                        <div style="margin-bottom: 44px">Berat Badan Normal</div>
                        <div style="margin-bottom: 44px">Kelebihan Berat Badan</div>
                        <div style="margin-bottom: 44px">Obesitas Kelas I</div>
                        <div style="margin-bottom: 44px">Obesitas Kelas II</div>
                        <div>Obesitas Kelas III</div>
                    </div>

                    <!-- Category Circle -->
                    <div class="category-circle"
                        style="position: absolute; right: 182px; top: 152px; width: 436px; height: 432px; background: #D4F3B7; border-radius: 50%; z-index: 1;">
                        <div
                            style="position: relative; top: 139px; text-align: center; color: black; font-size: 48px; font-family: Poppins; font-weight: 700">
                            Kategori<br />BMI
                        </div>
                    </div>
                </div>
            </div>



            <x-footer />
        </div>


        {{-- footer --}}


</body>

</html>
