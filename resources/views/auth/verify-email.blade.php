<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Auth System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-50 to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6 text-center">
            <div class="text-4xl text-orange-500 mb-2">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email Anda</h2>
            <p class="text-gray-600 text-sm">Kami telah mengirimkan link verifikasi ke email Anda. Silakan cek inbox (atau folder spam).</p>

            @if (session('message'))
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-sm">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-amber-600 text-white py-3 px-4 rounded-lg font-medium hover:from-orange-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200">
                    Kirim Ulang Link Verifikasi
                </button>
            </form>

            <div class="text-center text-sm text-gray-600">
                <p>Salah email? <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-orange-600 hover:text-orange-500 font-medium">Keluar</a> dan daftar ulang.</p>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</body>
</html>


