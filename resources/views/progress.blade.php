<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress BMI - FitCount</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    <x-header />

    <div class="px-4 md:px-12 py-8 md:py-12 max-w-7xl mx-auto">
        <!-- Profile Card -->
        <div class="bg-[#385723] rounded-[50px] p-4 md:p-8 relative overflow-hidden">
            <a href="{{ route('account') }}">
                <div class="absolute inset-0 opacity-5">
                    <img src="{{ asset('images/image12.svg') }}" alt="Pattern" class="w-full h-full object-cover">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-4 md:gap-8">
                    <div class="w-32 h-32 md:w-[183px] md:h-[183px]">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" class="w-full h-full rounded-full">
                        @else
                            <div class="w-full h-full bg-gray-300 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-3/5 h-3/5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="text-white text-center md:text-left">
                        <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4">
                            <h1 class="text-xl md:text-2xl lg:text-4xl font-bold">{{ Auth::user()->name }}, </h1>
                            <p class="text-base md:text-lg lg:text-xl font-light">{{ Auth::user()->age }} years old</p>
                        </div>
                        <p class="mt-2 md:mt-4 text-sm md:text-base lg:text-xl font-light">
                            {{ Auth::user()->email }} - {{ Auth::user()->height }} cm, {{ Auth::user()->weight }} Kg
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- BMI Graph Section -->
        <div style="margin-top: 48px; background: white; border: 3px solid #385723; border-radius: 15px; padding: 32px;">
            <div style="text-align: center;">
                <h2 style="font-size: 2.25rem; font-weight: 600; margin-bottom: 16px;">Perkembangan Kadar BMI</h2>
                <p style="color: #6B7280;">Histori Grafik perjalanan BMI Kamu</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex justify-center mt-6 md:mt-8">
                <div class="bg-[#385723] rounded-xl p-2 flex flex-wrap md:flex-nowrap gap-2 md:gap-4">
                    <button id="daily-btn" onclick="filterData('daily')" class="px-4 md:px-8 py-2 rounded-lg bg-[#A5B987] text-white font-semibold text-sm md:text-base">Hari</button>
                    <button id="weekly-btn" onclick="filterData('weekly')" class="px-4 md:px-8 py-2 rounded-lg bg-[#A5B987] text-white font-semibold text-sm md:text-base">Minggu</button>
                    <button id="monthly-btn" onclick="filterData('monthly')" class="px-4 md:px-8 py-2 rounded-lg bg-[#A5B987] text-white font-semibold text-sm md:text-base">Bulan</button>
                    <button id="yearly-btn" onclick="filterData('yearly')" class="px-4 md:px-8 py-2 rounded-lg bg-white text-black font-semibold text-sm md:text-base">Tahun</button>
                </div>
            </div>

            <!-- Graph Container -->
            <div class="mt-6 md:mt-8 h-[250px] md:h-[350px] relative max-w-[800px] mx-auto">
                <div id="bmi-details" class="hidden absolute -top-10 left-1/2 transform -translate-x-1/2 bg-[#385723] text-white px-4 py-2 rounded-lg text-center z-10 transition-all duration-300">
                    <p class="text-xs md:text-sm font-medium m-0">
                        Score: <span id="bmi-score"></span> | Category: <span id="bmi-category"></span>
                    </p>
                </div>

                <div id="bmi-graph" class="flex items-end justify-center gap-3 md:gap-5 h-full px-2 md:px-12">
                    @foreach ($bmiRecords as $record)
                        <div class="bmi-bar" onclick="showBmiDetails(this)"
                             data-score="{{ $record->bmi_score }}"
                             data-category="{{ $record->bmi_category }}"
                             style="height: {{ min($record->bmi_score * 3, 300) }}px;"
                             class="flex flex-col items-center cursor-pointer">
                            <div class="w-3 md:w-5 bg-[#385723] rounded-lg h-full"></div>
                            <span class="mt-1 text-[10px] md:text-xs">{{ $record->created_at->format('M d') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row justify-center gap-4 md:gap-8 mt-6 md:mt-8">
                <a href="{{ route('home') }}#bmi-section" class="px-6 md:px-12 py-3 md:py-4 border border-black rounded-lg font-semibold text-base md:text-xl text-center">
                    Hitung Lagi
                </a>
                <a href="{{ route('home') }}#bmi-section" class="px-6 md:px-12 py-3 md:py-4 bg-[#94AB71] border border-[#F9EDB2] rounded-lg text-white font-semibold text-base md:text-xl text-center">
                    Tambah Data
                </a>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Keep the existing JavaScript code unchanged
        let activeButton = 'yearly';
        let currentTimeout;

        document.addEventListener('DOMContentLoaded', () => {
            filterData('yearly');
        });

        function filterData(period) {
            setActiveButton(period);
            fetch(`/filter-bmi/${period}`)
                .then(response => response.json())
                .then(data => updateGraph(data.records))
                .catch(error => console.error('Error:', error));
        }

        function setActiveButton(period) {
            document.querySelectorAll('button').forEach(button => {
                button.style.background = '#A5B987';
                button.style.color = 'white';
            });
            const activeBtn = document.getElementById(`${period}-btn`);
            activeBtn.style.background = 'white';
            activeBtn.style.color = 'black';
            activeButton = period;
        }

        function updateGraph(records) {
            const graphContainer = document.getElementById('bmi-graph');
            graphContainer.innerHTML = '';

            records.forEach(record => {
                const bar = document.createElement('div');
                bar.className = 'bmi-bar flex flex-col items-center cursor-pointer';
                bar.style.height = `${Math.min(record.bmi_score * 3, 300)}px`;
                bar.setAttribute('data-score', record.bmi_score);
                bar.setAttribute('data-category', record.bmi_category);
                bar.onclick = () => showBmiDetails(bar);

                const barDiv = document.createElement('div');
                barDiv.className = 'w-3 md:w-5 bg-[#385723] rounded-lg h-full';

                const dateSpan = document.createElement('span');
                dateSpan.className = 'mt-1 text-[10px] md:text-xs';
                dateSpan.textContent = new Date(record.created_at).toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                });

                bar.appendChild(barDiv);
                bar.appendChild(dateSpan);
                graphContainer.appendChild(bar);
            });
        }

        function showBmiDetails(bar) {
            const bmiScore = bar.getAttribute('data-score');
            const bmiCategory = bar.getAttribute('data-category');

            const detailsDiv = document.getElementById('bmi-details');
            document.getElementById('bmi-score').textContent = bmiScore;
            document.getElementById('bmi-category').textContent = bmiCategory;

            if (currentTimeout) {
                clearTimeout(currentTimeout);
            }

            detailsDiv.style.display = 'block';

            currentTimeout = setTimeout(() => {
                detailsDiv.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
