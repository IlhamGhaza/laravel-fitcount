<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitCount- Account</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 640px) {
            .profile-content {
                flex-direction: column;
                text-align: center;
            }

            .profile-avatar {
                margin: 0 auto;
                width: 120px;
                height: 120px;
            }

            .action-buttons {
                justify-content: center;
            }
        }
    </style>
</head>

<body class="bg-white">
    <!-- Flash Messages -->
    @if (session('success'))
        <div id="success-message" class="fixed z-50 top-4 right-4 w-auto max-w-[90%] md:max-w-md">
            <div class="bg-[#BBE67A] text-[#385723] px-4 md:px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-base md:text-lg font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="fixed z-50 top-4 right-4 w-auto max-w-[90%] md:max-w-md">
            <div class="bg-[#FF2D20] text-white px-4 md:px-6 py-3 rounded-[30px] shadow-lg">
                <span class="text-base md:text-lg font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <x-header />

    <div class="min-h-screen bg-white">
        <div class="px-4 py-6 md:py-12 mx-auto max-w-7xl">
            <!-- Profile Section -->
            <div class="bg-[#385723] rounded-[30px] md:rounded-[50px] shadow-lg p-4 md:p-8 overflow-hidden relative">
                <div class="absolute inset-0 opacity-5">
                    <img src="{{ asset('images/image12.svg') }}" alt="Background Pattern"
                        class="object-cover w-full h-full">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-4 md:gap-8 profile-content">
                    <div class="profile-avatar w-[120px] h-[120px] md:w-[183px] md:h-[183px]">
                        @if (Auth::user()->avatar)
                            <img class="w-full h-full rounded-full object-cover"
                                src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Avatar" />
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-full h-full text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        @endif
                    </div>

                    <div class="text-white text-center md:text-left">
                        <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4">
                            <h1 class="text-2xl md:text-4xl font-bold">{{ Auth::user()->name }}, </h1>
                            <p class="text-lg md:text-xl font-light">{{ Auth::user()->age }} years old</p>
                        </div>
                        <p class="mt-2 md:mt-4 text-base md:text-xl font-light">
                            {{ Auth::user()->email }} - {{ Auth::user()->height }} cm, {{ Auth::user()->weight }} Kg
                        </p>

                        <div class="flex flex-wrap justify-center md:justify-start gap-3 md:gap-4 mt-4 action-buttons">
                            <a href="{{ route('users.edit') }}"
                                class="inline-flex items-center px-4 py-2 bg-[#BBE67A] rounded-[30px] font-medium text-[#385723] hover:bg-[#a5cc69] transition-colors">
                                <span class="text-base md:text-lg">Edit Profile</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white rounded-[30px] font-medium hover:bg-red-600 transition-colors">
                                    <span class="text-base md:text-lg">Logout</span>
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
                    <p class="font-bold text-center text-white text-8xl">
                        @php
                            $averageScore = $bmiRecords
                                ->groupBy(function ($date) {
                                    return $date->created_at->format('Y-m-d');
                                })
                                ->map(function ($group) {
                                    return $group->last()->bmi_score;
                                })
                                ->avg();
                        @endphp
                        {{ $averageScore ? number_format($averageScore, 2) : '0.00' }}
                    </p>
                </div>

                <div class="bg-[#385723] rounded-[20px] p-8 shadow-lg">
                    <h2 class="text-4xl font-bold text-center text-white">Kategori BMI</h2>
                    <div class="my-4 border-t border-white"></div>
                    <p class="text-6xl font-bold text-center text-white">
                        @php
                            $category = '';
                            if ($averageScore) {
                                if ($averageScore < 18.5) {
                                    $category = 'Underweight';
                                } elseif ($averageScore >= 18.5 && $averageScore < 24.9) {
                                    $category = 'Normal weight';
                                } elseif ($averageScore >= 25 && $averageScore < 29.9) {
                                    $category = 'Overweight';
                                } elseif ($averageScore >= 30 && $averageScore < 34.9) {
                                    $category = 'Obese 1';
                                } elseif ($averageScore >= 35 && $averageScore < 39.9) {
                                    $category = 'Obese 2';
                                } else {
                                    $category = 'Obese 3';
                                }
                            }
                        @endphp
                        {{ $category ?: 'Belum ada data' }}
                    </p>
                </div>
            </div>

            <!-- BMI History -->
            <div class="mt-12 bg-[#F6F6F6] rounded-lg shadow-lg p-4 md:p-8">
                <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-8">
                    <h2 class="text-2xl md:text-4xl font-semibold mb-2 md:mb-0">Histori Skor BMI</h2>
                    <a href="{{ route('progress') }}" class="text-[#385723] text-lg md:text-xl font-semibold">Lihat
                        Semua ></a>
                </div>

                @if (Auth::check() && $bmiRecords->count() > 0)
                    <div class="relative h-[200px] md:h-[300px]">
                        <!-- Graph Container -->
                        <div class="w-full h-[150px] md:h-[200px] relative overflow-x-auto md:overflow-x-visible">
                            <div class="min-w-[500px] md:min-w-full h-full relative">
                                <!-- Graph Lines with Max Angle Constraint -->
                                <div class="absolute inset-0 flex items-center justify-between">
                                    @foreach ($bmiRecords as $index => $record)
                                        @if (!$loop->last)
                                            @php
                                                $nextRecord = $bmiRecords[$index + 1];
                                                $angle = min(
                                                    max(($record->bmi_score - $nextRecord->bmi_score) * 5, -15),
                                                    15,
                                                );
                                            @endphp
                                            <div class="flex-1 h-1 bg-[#B8C8A1]"
                                                style="transform: rotate({{ $angle }}deg); transform-origin: left center;">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Data Points -->
                                <div class="absolute inset-0 flex items-center justify-between">
                                    @foreach ($bmiRecords as $record)
                                        <div class="relative flex flex-col items-center">
                                            <div class="w-3 h-3 md:w-4 md:h-4 bg-[#385723] rounded-full"></div>
                                            <div class="mt-2 text-xs md:text-sm font-medium">
                                                {{ number_format($record->bmi_score, 1) }}
                                            </div>
                                            <div class="mt-1 text-[10px] md:text-xs text-gray-600">
                                                {{ $record->created_at->format('d/m') }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-8 text-center">
                        <p class="text-[#385723] text-lg md:text-xl font-semibold">Perkembangan Skor BMI</p>
                    </div>
                @else
                    <div class="py-4 md:py-8 text-center">
                        <p class="text-gray-500">Belum ada data BMI yang tersimpan</p>
                    </div>
                @endif
            </div>
            <!-- End of BMI History -->

            <!-- To Do List -->
            <div class="mt-12 bg-[#385723]/20 py-8 md:py-12">
                <div class="px-4 mx-auto max-w-7xl">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl md:text-4xl font-bold">To do list</h2>
                        <a href="{{ route('todo') }}" class="text-[#385723] text-base md:text-xl font-semibold">Lihat
                            Semua></a>
                    </div>

                    <!-- Task Progress Circles -->
                    <div class="flex flex-wrap justify-center gap-4 md:gap-8 mt-4 md:mt-8">
                        @php
                            $today = now();
                            $weekStart = $today->startOfWeek();
                        @endphp

                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $currentDate = $weekStart->copy()->addDays($i);
                                $completedTasks = Auth::user()
                                    ->tasks()
                                    ->whereDate('created_at', $currentDate)
                                    ->where('status', 'completed')
                                    ->get();

                                // \Log::info('Date: ' . $currentDate . ' Complete Tasks: ' . $completedTasks->count());
                            @endphp

                            <div class="flex flex-col items-center">
                                <div
                                    class="w-[60px] h-[60px] md:w-[90px] md:h-[90px] rounded-full shadow-md flex items-center justify-center
                        {{ $completedTasks->count() > 0 ? 'bg-[#A5B987]' : 'bg-[#C7C7C7]' }}">
                                    @if ($completedTasks->count() > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-10 h-10 md:w-16 md:h-16 text-[#F9EDB2]" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                </div>
                                <span class="mt-2 md:mt-4 text-xl md:text-3xl font-bold">{{ $i + 1 }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>


        </div>
    </div>

    <x-footer />

    <script>
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) successMessage.style.display = 'none';
            if (errorMessage) errorMessage.style.display = 'none';
        }, 3000);
    </script>
</body>

</html>
