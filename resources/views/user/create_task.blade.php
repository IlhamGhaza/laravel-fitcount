<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitCount - Todo</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-header />

    @if (session('success'))
        <div id="success-message" class="fixed z-50 top-4 right-4">
            <div class="px-6 py-3 text-green-800 bg-green-100 rounded-lg shadow-md">
                <span class="text-base font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div id="error-message" class="fixed z-50 top-4 right-4">
            <div class="px-6 py-3 text-red-800 bg-red-100 rounded-lg shadow-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-base font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <main>
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="relative h-[300px] rounded-xl overflow-hidden mb-8">
                <img src="{{ asset('images/image13.svg') }}" alt="Hero Background" class="object-cover w-full h-full">
                <div class="absolute inset-0 bg-black/50">
                    <div class="absolute -translate-y-1/2 left-8 top-1/2">
                        <h1 class="text-3xl font-semibold leading-tight text-white md:text-4xl">
                            Tambah tugas baru<br>untuk produktivitas<br>yang lebih baik.
                        </h1>
                    </div>
                </div>
            </div>

            <!-- Create Task Form -->
            <div class="p-6 bg-white shadow-sm md:p-8 bg-[rgba(225,225,225,0.5)] rounded-[10px]">
                <h2 class="mb-8 text-2xl font-semibold md:text-3xl font-poppins">Tambah Tugas Baru</h2>

                <form action="{{ route('todo.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="task_name" class="block text-lg font-medium text-gray-700">Nama Tugas</label>
                        <input type="text" name="task_name" id="task_name" required
                            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-[#94AB71] focus:border-[#94AB71]">
                    </div>

                    <div>
                        <label for="description" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-[#94AB71] focus:border-[#94AB71]"></textarea>
                    </div>

                    <div>
                        <label for="priority" class="block text-lg font-medium text-gray-700">Prioritas</label>
                        <select name="priority" id="priority" required
                            class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-[#94AB71] focus:border-[#94AB71]">
                            <option value="low">Rendah</option>
                            <option value="medium">Sedang</option>
                            <option value="high">Tinggi</option>
                        </select>
                    </div>

                    <input type="hidden" name="status" value="pending">

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('todo') }}"
                            class="px-6 py-2 text-[#94AB71] border border-[#94AB71] rounded-md hover:bg-[#94AB71] hover:text-white transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 text-white bg-[#94AB71] rounded-md hover:bg-[#7A8F5C] transition-colors">
                            Tambah Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <x-footer />

    <script>
        setTimeout(() => {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.style.opacity = '0';
                successMessage.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => successMessage.remove(), 500);
            }

            if (errorMessage) {
                errorMessage.style.opacity = '0';
                errorMessage.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => errorMessage.remove(), 500);
            }
        }, 3000);
    </script>
</body>

</html>
