<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Auth System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Header with Animation -->
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-500 to-indigo-600 bg-clip-text text-transparent mb-3">
                    Reset Password
                </h1>
            </div>

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
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Hidden Token -->
                    <input type="hidden" name="token" value="{{ $token }}">
                    
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
                                class="block w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-100 focus:border-green-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="Masukkan email Anda"
                                required
                            >
                        </div>
                    </div>

                    <!-- New Password Field with Enhanced Styling -->
                    <div class="space-y-3">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>
                            Password Baru
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="block w-full pl-12 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-100 focus:border-green-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                onclick="togglePassword('password')"
                            >
                                <i id="password-icon" class="fas fa-eye text-lg"></i>
                            </button>
                        </div>
                        <div id="password-alert" class="hidden">
                            <p class="text-xs text-orange-600 bg-orange-50 px-3 py-2 rounded-lg border border-orange-200">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Password minimal 8 karakter
                            </p>
                        </div>
                    </div>

                    <!-- Confirm Password Field with Enhanced Styling -->
                    <div class="space-y-3">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-shield-alt mr-2 text-blue-500"></i>
                            Konfirmasi Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-shield-alt text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                            </div>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                class="block w-full pl-12 pr-12 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-100 focus:border-green-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                placeholder="Ulangi password baru"
                                required
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                onclick="togglePassword('password_confirmation')"
                            >
                                <i id="password_confirmation-icon" class="fas fa-eye text-lg"></i>
                            </button>
                        </div>
                        <div id="password-confirm-alert" class="hidden">
                            <p class="text-xs text-red-600 bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <i class="fas fa-times-circle mr-1"></i>
                                Password tidak cocok
                            </p>
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div id="password-requirements" class="hidden bg-blue-50 border border-blue-200 rounded-xl p-4 transition-all duration-300">
                        <h4 class="text-sm font-semibold text-blue-800 mb-2">
                            <i class="fas fa-info-circle mr-2"></i>
                            Password harus memenuhi:
                        </h4>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li class="flex items-center">
                                <i class="fas fa-check text-blue-500 mr-2"></i>
                                Minimal 8 karakter
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-blue-500 mr-2"></i>
                                Kombinasi huruf dan angka
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-blue-500 mr-2"></i>
                                Tidak boleh sama dengan password lama
                            </li>
                        </ul>
                    </div>

                    <!-- Submit Button with Enhanced Styling -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-4 px-6 rounded-xl font-semibold text-lg hover:from-blue-600 hover:to-indigo-700  focus:outline-none focus:ring-4 focus:ring-green-200 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl shadow-lg"
                    >
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .bg-grid-pattern {
            background-image: 
                linear-gradient(rgba(16, 185, 129, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .animate-fade-in { animation: fade-in 0.6s ease-out; }
        .animate-shake { animation: shake 0.6s ease-out; }
    </style>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(`${inputId}-icon`);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Real-time password validation
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const alert = document.getElementById('password-alert');
            const requirements = document.getElementById('password-requirements');
            
            // Show requirements box when user starts typing
            if (password.length > 0) {
                requirements.classList.remove('hidden');
                requirements.classList.add('animate-fade-in');
            } else {
                requirements.classList.add('hidden');
            }
            
            if (password.length > 0 && password.length < 8) {
                alert.classList.remove('hidden');
            } else {
                alert.classList.add('hidden');
            }
            
            // Check password confirmation match
            checkPasswordMatch();
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            checkPasswordMatch();
        });

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const alert = document.getElementById('password-confirm-alert');
            
            if (confirmPassword.length > 0 && password !== confirmPassword) {
                alert.classList.remove('hidden');
            } else {
                alert.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
