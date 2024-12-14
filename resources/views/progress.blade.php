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

<body style="background-color: white; min-height: 100vh;">
    <x-header />

    <div style="padding: 48px 16px; max-width: 80rem; margin: 0 auto;">
        <!-- Profile Card -->
        <div style="background-color: #385723; border-radius: 50px; padding: 32px; position: relative; overflow: hidden;">
            <a href="{{ route('account') }}">
                <div style="position: absolute; inset: 0; opacity: 0.05;">
                    <img src="{{ asset('images/image12.svg') }}" alt="Pattern" style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <div style="position: relative; z-index: 10; display: flex; align-items: center; gap: 32px;">
                    <div style="width: 183px; height: 183px;">
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" style="width: 100%; height: 100%; border-radius: 50%;">
                        @else
                            <div style="width: 100%; height: 100%; background: #ddd; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 60%; height: 60%; color: white;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div style="color: white;">
                        <div style="display: flex; align-items: center; gap: 16px;">
                            <h1 style="font-size: 2.25rem; font-weight: 700;">{{ Auth::user()->name }}, </h1>
                            <p style="font-size: 1.25rem; font-weight: 300;">{{ Auth::user()->age }} years old</p>
                        </div>
                        <p style="margin-top: 16px; font-size: 1.25rem; font-weight: 300;">
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
            <div style="display: flex; justify-content: center; margin-top: 32px;">
                <div style="background: #385723; border-radius: 15px; padding: 8px; display: flex; gap: 16px;">
                    <button id="daily-btn" onclick="filterData('daily')" style="padding: 8px 32px; border-radius: 10px; background: #A5B987; color: white; font-weight: 600;">Hari</button>
                    <button id="weekly-btn" onclick="filterData('weekly')" style="padding: 8px 32px; border-radius: 10px; background: #A5B987; color: white; font-weight: 600;">Minggu</button>
                    <button id="monthly-btn" onclick="filterData('monthly')" style="padding: 8px 32px; border-radius: 10px; background: #A5B987; color: white; font-weight: 600;">Bulan</button>
                    <button id="yearly-btn" onclick="filterData('yearly')" style="padding: 8px 32px; border-radius: 10px; background: white; color: black; font-weight: 600;">Tahun</button>
                </div>
            </div>

            <!-- Graph Container -->
            <div style="margin: 32px auto; height: 350px; position: relative; max-width: 800px;">
                <!-- BMI Details Popup -->
                <div id="bmi-details" style="display: none; position: absolute; top: -40px; left: 50%; transform: translateX(-50%); background: #385723; color: white; padding: 8px 16px; border-radius: 10px; text-align: center; z-index: 10; transition: all 0.3s ease;">
                    <p style="font-size: 0.9rem; font-weight: 500; margin: 0;">
                        Score: <span id="bmi-score"></span> | Category: <span id="bmi-category"></span>
                    </p>
                </div>

                <div id="bmi-graph" style="display: flex; align-items: flex-end; justify-content: center; gap: 20px; height: 100%; padding: 0 48px;">
                    @foreach ($bmiRecords as $record)
                        <div class="bmi-bar" onclick="showBmiDetails(this)"
                             data-score="{{ $record->bmi_score }}"
                             data-category="{{ $record->bmi_category }}"
                             style="display: flex; flex-direction: column; align-items: center; cursor: pointer; height: {{ min($record->bmi_score * 3, 300) }}px;">
                            <div style="width: 20px; background: #385723; border-radius: 10px; height: 100%;"></div>
                            <span style="margin-top: 4px; font-size: 0.75rem;">{{ $record->created_at->format('M d') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; justify-content: center; gap: 32px; margin-top: 32px;">
                <a href="{{ route('home') }}#bmi-section" style="padding: 16px 48px; border: 1px solid black; border-radius: 10px; font-weight: 600; font-size: 1.25rem;">
                    Hitung Lagi
                </a>
                <a href="{{ route('home') }}#bmi-section" style="padding: 16px 48px; background: #94AB71; border: 1px solid #F9EDB2; border-radius: 10px; color: white; font-weight: 600; font-size: 1.25rem;">
                    Tambah Data
                </a>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
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
                bar.className = 'bmi-bar';
                bar.style.cssText = `
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    cursor: pointer;
                    height: ${Math.min(record.bmi_score * 3, 300)}px;
                `;
                bar.setAttribute('data-score', record.bmi_score);
                bar.setAttribute('data-category', record.bmi_category);
                bar.onclick = () => showBmiDetails(bar);

                const barDiv = document.createElement('div');
                barDiv.style.cssText = `
                    width: 20px;
                    background: #385723;
                    border-radius: 10px;
                    height: 100%;
                `;

                const dateSpan = document.createElement('span');
                dateSpan.style.cssText = `
                    margin-top: 4px;
                    font-size: 0.75rem;
                `;
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
