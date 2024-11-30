<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FitCount - Home</title>

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
</head>

<body>
    <x-header />

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

    {{-- design --}}


    {{-- footer --}}
    <x-footer />
</body>

</html>
