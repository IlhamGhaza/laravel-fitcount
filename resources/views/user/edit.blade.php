<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitCount- Edit Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-header />

    <div class="min-h-screen bg-white">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-[#385723] rounded-[50px] shadow-lg p-8">
                <h2 class="mb-8 text-4xl font-bold text-white">Edit Profile</h2>

                <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" class="space-y-6"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-xl text-white">Name</label>
                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-xl text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                        </div>

                        <div>
                            <label for="gender" class="block mb-2 text-xl text-white">Gender</label>
                            <select name="gender" id="gender"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                                <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="age" class="block mb-2 text-xl text-white">Age</label>
                            <input type="number" name="age" id="age" value="{{ Auth::user()->age }}"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                        </div>

                        <div>
                            <label for="height" class="block mb-2 text-xl text-white">Height (cm)</label>
                            <input type="number" step="0.01" name="height" id="height"
                                value="{{ Auth::user()->height }}"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                        </div>

                        <div>
                            <label for="weight" class="block mb-2 text-xl text-white">Weight (kg)</label>
                            <input type="number" step="0.01" name="weight" id="weight"
                                value="{{ Auth::user()->weight }}"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                        </div>

                        <div>
                            <label for="avatar" class="block mb-2 text-xl text-white">Profile Picture</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*"
                                class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white file:mr-4 file:py-2 file:px-4 file:rounded-[30px] file:border-0 file:bg-[#BBE67A] file:text-[#385723]">
                        </div>
                    </div>

                    <!-- Separated Password Section -->
                    <div class="mt-8 p-6 bg-white/10 rounded-[20px] border-2 border-white">
                        <h3 class="text-2xl font-bold text-white mb-4">Change Password</h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="password" class="block mb-2 text-xl text-white">New Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block mb-2 text-xl text-white">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full h-[63px] bg-white/20 border-2 border-white rounded-[7px] px-4 text-white placeholder-[#C7C7C7] backdrop-blur-[20px]">
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-center mt-8">
                        <button type="submit" class="w-[238px] h-[44px] bg-[#BBE67A] rounded-[30px]">
                            <span class="text-[20px] font-medium text-[#385723] font-poppins">Update Profile</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
</body>

</html>
