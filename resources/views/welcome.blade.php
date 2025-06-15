<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex items-center justify-center">
    <div class="text-center bg-white shadow-xl p-10 rounded-2xl max-w-md">
        <h1 class="text-3xl font-bold mb-6">Welcome to My Portfolio</h1>
        <p class="mb-8 text-gray-600">Choose how you'd like to continue:</p>

        <div class="flex flex-col gap-4">
            <a href="{{ route('login') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                Log In
            </a>

            <a href="{{ route('register') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
                Register
            </a>
        </div>
    </div>
</div>

</body>
</html>
