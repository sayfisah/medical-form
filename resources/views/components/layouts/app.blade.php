<!DOCTYPE html>
<html>
<head>
    <title>Medical Form System</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom CSS per form --}}
    @stack('form-css')

    @livewireStyles
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6">
        {{ $slot }}
    </div>

    @livewireScripts
    
    
</body>
</html>
