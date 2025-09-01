<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Auth System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Header with Animation -->
            <div class="text-center mb-8 animate-fade-in">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl mb-6 shadow-lg transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-key text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-500 to-indigo-600 bg-clip-text text-transparent mb-3">
                    Lupa Password?
                </h1>
            </div>

            <!-- Success Message with Animation -->
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-400 to-emerald-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg transform animate-bounce-in">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold text-lg">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Messages with Animation -->
            @if($errors->any())
                <div class="bg-gradient-to-r from-red-400 to-pink-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg transform animate-shake">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-exclamation-triangle text-2xl mr-3"></i>
                        <span class="font-semibold text-lg">Terjadi kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside text-red-100 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field with Enhanced Styling -->
                    <div class="space-y-3">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>
                            Email Address
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                value="{{ old('email') }}"
                                class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="Masukkan email Anda"
                                required
                            >
                        </div>
                        <p class="text-xs text-gray-500 ml-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Enter your account email address to receive instructions on resetting your password.
                        </p>
                    </div>

                    <!-- Submit Button with Enhanced Styling -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-4 px-6 rounded-xl font-semibold text-lg hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-200 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl shadow-lg"
                    >
                        <i class="fas fa-paper-plane mr-3"></i>
                        Send Email
                    </button>
                </form>

                <!-- Back to Login with Enhanced Styling -->
                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200 group">
                        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
                        Kembali ke Login
                    </a>
                </div>
            </div>

            <!-- Footer with Enhanced Styling -->
            <div class="text-center mt-8">
                <p class="text-gray-500">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold hover:underline transition-all duration-200">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        .bg-grid-pattern {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes bounce-in {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .animate-fade-in { animation: fade-in 0.6s ease-out; }
        .animate-bounce-in { animation: bounce-in 0.6s ease-out; }
        .animate-shake { animation: shake 0.6s ease-out; }
    </style>
</body>
</html>
