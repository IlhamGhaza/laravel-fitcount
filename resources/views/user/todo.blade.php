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

        @media (max-width: 768px) {
            .task-card {
                height: auto;
                flex-direction: column;
            }

            .task-card > div:first-child {
                width: 100%;
                height: 10px;
                border-radius: 15px 15px 0 0;
            }

            .task-card h3 {
                font-size: 24px;
            }

            .task-card p {
                font-size: 16px;
            }

            .task-card > div:last-child {
                width: 100%;
                border-left: none;
                border-top: 1px solid black;
                padding: 10px 0;
            }
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
            <div class="relative h-[200px] md:h-[300px] rounded-xl overflow-hidden mb-8">
                <img src="{{ asset('images/image13.svg') }}" alt="Hero Background" class="object-cover w-full h-full">
                <div class="absolute inset-0 bg-black/50">
                    <div class="absolute -translate-y-1/2 left-4 md:left-8 top-1/2">
                        <h1 class="text-2xl md:text-4xl font-semibold leading-tight text-white">
                            Konsisten dan<br>presisten untuk<br>hidup yang efisien.
                        </h1>
                    </div>
                </div>
            </div>

            <div class="p-4 md:p-8 bg-white shadow-sm bg-[rgba(225,225,225,0.5)] rounded-[10px]">
                <h2 class="mb-6 md:mb-8 text-xl md:text-3xl font-semibold font-poppins">Tugas saya hari ini</h2>

                <a href="{{ route('todo.create') }}" class="block mb-6 md:mb-[53px]">
                    <div class="w-full md:w-[1019px] h-[60px] md:h-[76px] bg-white shadow-md rounded-[30px] flex items-center px-4 md:px-[71px] hover:bg-gray-50 transition-colors duration-200">
                        <div class="w-[40px] md:w-[60px] h-[40px] md:h-[57px] bg-[#A5B987] rounded-[15px] flex items-center justify-center">
                            <span class="text-white text-[32px] md:text-[48px] font-bold leading-none">+</span>
                        </div>
                        <span class="ml-4 md:ml-[83px] text-lg md:text-[24px] font-semibold font-poppins tracking-[1px]">Tambah tugas baru</span>
                    </div>
                </a>

                @foreach ($tasks as $task)
                    <div class="mb-6 md:mb-8">
                        <div class="flex flex-col md:flex-row relative min-h-[146px] bg-white rounded-[15px] shadow-md task-card {{ $task->status === 'completed' ? 'completed' : '' }}">
                            <div class="w-full md:w-[181px] h-[10px] md:h-auto {{ $task->priority === 'high' ? 'bg-[#F5833D]' : ($task->priority === 'medium' ? 'bg-[#F9EDB2]' : 'bg-[#A5B987]') }} rounded-t-[15px] md:rounded-l-[15px] md:rounded-tr-none md:shadow-[4px_0px_4px_rgba(0,0,0,0.25)]">
                            </div>
                            <div class="flex-1 p-4 md:p-6">
                                <h3 class="text-2xl md:text-[40px] font-semibold font-poppins mb-2 {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                    {{ $task->task_name }}
                                </h3>
                                <p class="text-base md:text-[24px] font-light font-poppins {{ $task->status === 'completed' ? 'text-gray-500' : '' }}">
                                    {{ $task->description }}
                                </p>
                            </div>
                            <div class="w-full md:w-[132px] border-t md:border-l border-black flex items-center justify-center p-4 md:p-0">
                                <form action="{{ route('todo.updateStatus', $task) }}" method="POST" class="task-form">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                                    <button type="button" class="checkbox-container flex items-center justify-center w-8 md:w-10 h-8 md:h-10 border-3 border-[#94AB71] rounded-lg hover:bg-[#94AB71]/10 transition-all duration-200 {{ $task->status === 'completed' ? 'bg-[#94AB71]' : '' }} outline outline-2 outline-black">
                                        @if($task->status === 'completed')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 md:w-6 h-5 md:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <div class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 w-[90%] max-w-[400px]">
            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-xl">
                <h3 class="mb-4 text-xl md:text-2xl font-semibold font-poppins">Konfirmasi Status</h3>
                <p class="mb-6 text-base md:text-lg">Apakah Anda yakin ingin mengubah status tugas ini?</p>
                <div class="flex justify-end space-x-4">
                    <button id="cancelButton" class="px-4 md:px-6 py-2 rounded-lg border-2 border-[#94AB71] text-[#94AB71] hover:bg-[#94AB71]/10 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="confirmButton" class="px-4 md:px-6 py-2 rounded-lg bg-[#94AB71] text-white hover:bg-[#7A8F5C] transition-colors duration-200">
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
