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
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        html {
            scroll-behavior: smooth;
        }

        .task-card {
            transition: all 0.3s ease;
        }

        .task-card.completed {
            opacity: 0.7;
            background-color: #F5F5F5;
        }

        .checkbox-container {
            transition: all 0.2s ease;
        }

        .checkbox-container:hover {
            transform: scale(1.1);
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
            <div class="relative h-[300px] rounded-xl overflow-hidden mb-8">
                <img src="{{ asset('images/image13.svg') }}" alt="Hero Background" class="object-cover w-full h-full">
                <div class="absolute inset-0 bg-black/50">
                    <div class="absolute -translate-y-1/2 left-8 top-1/2">
                        <h1 class="text-3xl font-semibold leading-tight text-white md:text-4xl">
                            Konsisten dan<br>presisten untuk<br>hidup yang efisien.
                        </h1>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white shadow-sm md:p-8 bg-[rgba(225,225,225,0.5)] rounded-[10px]">
                <h2 class="mb-8 text-2xl font-semibold md:text-3xl font-poppins">Tugas saya hari ini</h2>

                <a href="{{ route('todo.create') }}" class="block mb-[53px]">
                    <div class="w-[1019px] h-[76px] bg-white shadow-md rounded-[30px] flex items-center px-[71px] hover:bg-gray-50 transition-colors duration-200">
                        <div class="w-[60px] h-[57px] bg-[#A5B987] rounded-[15px] flex items-center justify-center">
                            <span class="text-white text-[48px] font-bold leading-none">+</span>
                        </div>
                        <span class="ml-[83px] text-[24px] font-semibold font-poppins tracking-[1px]">Tambah tugas baru</span>
                    </div>
                </a>

                @foreach ($tasks as $task)
                    <div class="mb-8">
                        <div class="flex relative h-[146px] bg-white rounded-[15px] shadow-md task-card {{ $task->status === 'completed' ? 'completed' : '' }}">
                            <div class="w-[181px] {{ $task->priority === 'high' ? 'bg-[#F5833D]' : ($task->priority === 'medium' ? 'bg-[#F9EDB2]' : 'bg-[#A5B987]') }} rounded-l-[15px] shadow-[4px_0px_4px_rgba(0,0,0,0.25)]">
                            </div>
                            <div class="flex-1 p-6">
                                <h3 class="text-[40px] font-semibold font-poppins mb-2 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->task_name }}
                                </h3>
                                <p class="text-[24px] font-light font-poppins {{ $task->status === 'completed' ? 'text-gray-500' : '' }}">
                                    {{ $task->description }}
                                </p>
                            </div>
                            <div class="w-[132px] border-l border-black flex items-center justify-center">
                                <form action="{{ route('todo.updateStatus', $task) }}" method="POST" class="task-form">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                                    <button type="button" class="checkbox-container flex items-center justify-center w-10 h-10 border-3 border-[#94AB71] rounded-lg hover:bg-[#94AB71]/10 transition-all duration-200 {{ $task->status === 'completed' ? 'bg-[#94AB71]' : '' }} outline outline-2 outline-black">
                                        @if($task->status === 'completed')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            <div class="bg-white rounded-2xl p-8 shadow-xl w-[400px]">
                <h3 class="mb-4 text-2xl font-semibold font-poppins">Konfirmasi Status</h3>
                <p class="mb-6 text-lg">Apakah Anda yakin ingin mengubah status tugas ini?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelButton" class="px-6 py-2 rounded-lg border-2 border-[#94AB71] text-[#94AB71] hover:bg-[#94AB71]/10 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="confirmButton" class="px-6 py-2 rounded-lg bg-[#94AB71] text-white hover:bg-[#7A8F5C] transition-colors duration-200">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Message fade out
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

        // Modal handling
        const modal = document.getElementById('confirmationModal');
        const confirmBtn = document.getElementById('confirmButton');
        const cancelBtn = document.getElementById('cancelButton');
        let currentForm = null;

        document.querySelectorAll('.checkbox-container').forEach(button => {
            button.addEventListener('click', (e) => {
                currentForm = e.target.closest('form');
                modal.classList.remove('hidden');
            });
        });

        confirmBtn.addEventListener('click', () => {
            if (currentForm) {
                currentForm.submit();
            }
            modal.classList.add('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            currentForm = null;
        });
    </script>
</body>

</html>
