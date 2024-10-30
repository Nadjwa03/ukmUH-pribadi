<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Admin UKM </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
{{-- navbar --}}

<body class="font-poppins antialiased bg-red-900">
    <nav class="bg-red-900 text-white ml-20py-4">
        <div class="con mx-20  flex justify-between items-center ">
            {{-- logo --}}
            <div class="flex my-2 items-center space-x-2">
                <img src="{{ asset('asset/Heading.png') }}" alt="logo-unhas-putih" class="  w-56">
            </div>
            {{-- link --}}
            <ul class="flex space-x-8">
                <li><a href="#" class="hover:text-gray-300 transition">HOME</a></li>
                <li><a href="#" class="hover:text-gray-300 transition">UKM</a></li>
                <li><a href="#" class="hover:text-gray-300 transition">DAFTAR</a></li>
            </ul>
        </div>
    </nav>
    <div class=" flex items-center justify-center py-8">
        <div class="bg-white  shadow-md rounded-lg  flex w-full max-w-7xl h-full ">
            {{-- kiri --}}
            <div class ="w-auto">
                <img src="{{ asset('asset/login-img.JPG') }}" alt="Image-rektorat-login" class=" max-w-lg rounded-l-lg">
            </div>
            {{-- kanan --}}
            <div class="w-1/2 ml-16 p-8 flex flex-col justify-center">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-red-900"> LOGIN ADMIN UKM</h2>
                </div>
                <form action="/admin/auth/login" method="post" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" placeholder="Input your email"
                            class="mt-1 px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-900 w-full" />
                        @error('email')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block test-sm font-medium text-gray-700">Password</label>
                        <input name="password" type="password" placeholder="Input your password"
                            class="mt-1 px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-900 focus:border-red-900 w-full" />
                        @error('password')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full py-3 px-4 bg-red-900 text-white rounded-md hover:bg-red-800 transition duration-300">Masuk</button>
                    </div>
            </div>
            
            </form>

        </div>
    </div>
</body>

</html>
