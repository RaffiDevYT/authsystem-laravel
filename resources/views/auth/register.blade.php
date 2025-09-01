<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Auth System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Register</h2>
            <p class="text-sm text-gray-600">Buat akun baru untuk memulai</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg mb-4">
                    <ul class="list-disc list-inside text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-2 rounded-lg mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span class="text-xs">{{ session('message') }}</span>
                    </div>
                </div>
            @endif

            @if (session('google_data'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-lg mb-4">
                    <div class="flex items-center">
                        <i class="fab fa-google mr-2"></i>
                        <span class="text-xs">Anda akan mendaftar menggunakan akun Google: <strong>{{ session('google_data.email') }}</strong></span>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <!-- Row 1: First Name & Last Name -->
                <div class="grid grid-cols-2 gap-4">
                                         <!-- First Name Field -->
                     <div>
                         <label for="first_name" class="block text-xs font-medium text-gray-700 mb-1">
                             Nama Depan <span class="text-red-500">*</span>
                         </label>
                         <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                 <i class="fas fa-user text-gray-400 text-sm"></i>
                             </div>
                             <input 
                                 id="first_name" 
                                 name="first_name" 
                                 type="text" 
                                 value="{{ old('first_name', session('google_data.name') ? explode(' ', session('google_data.name'))[0] : '') }}"
                                 class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                 placeholder="Masukkan nama depan"
                                 required
                             >
                         </div>
                     </div>

                                         <!-- Last Name Field -->
                     <div>
                         <label for="last_name" class="block text-xs font-medium text-gray-700 mb-1">
                             Nama Belakang <span class="text-red-500">*</span>
                         </label>
                         <div class="relative">
                             <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                 <i class="fas fa-user text-gray-400 text-sm"></i>
                             </div>
                             <input 
                                 id="last_name" 
                                 name="last_name" 
                                 type="text" 
                                 value="{{ old('last_name', session('google_data.name') ? implode(' ', array_slice(explode(' ', session('google_data.name')), 1)) : '') }}"
                                 class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                 placeholder="Masukkan nama belakang"
                                 required
                             >
                         </div>
                     </div>
                </div>

                <!-- Row 2: Email & Phone -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-medium text-gray-700 mb-1">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                value="{{ old('email', session('google_data.email') ?? '') }}"
                                class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                placeholder="Masukkan email Anda"
                                required
                                {{ session('google_data.email') ? 'readonly' : '' }}
                            >
                        </div>
                        @if(session('google_data.email'))
                            <p class="text-xs text-green-600 mt-1">
                                <i class="fas fa-lock mr-1"></i>Email dari akun Google Anda
                            </p>
                        @endif
                    </div>

                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone_number" class="block text-xs font-medium text-gray-700 mb-1">
                            No. Tlp <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                id="phone_number" 
                                name="phone_number" 
                                type="tel" 
                                value="{{ old('phone_number') }}"
                                class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                placeholder="Contoh: 08123456789"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Row 3: Password & Confirm Password -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-xs font-medium text-gray-700 mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="block w-full pl-8 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                onclick="togglePassword('password')"
                            >
                                <i id="password-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="password-alert" class="hidden">
                            <p class="text-xs text-orange-600 mt-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Password minimal 8 karakter
                            </p>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1">
                            Verif Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                class="block w-full pl-8 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                placeholder="Ulangi password Anda"
                                required
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                                onclick="togglePassword('password_confirmation')"
                            >
                                <i id="password_confirmation-icon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="password-confirm-alert" class="hidden">
                            <p class="text-xs text-red-600 mt-1">
                                <i class="fas fa-times-circle mr-1"></i>Password tidak cocok
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Row 4: Birth Date & Gender -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Birth Date Fields -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <!-- Birth Day -->
                            <select 
                                name="birth_day" 
                                class="block w-full px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                required
                            >
                                <option value="">Tanggal</option>
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ old('birth_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>

                            <!-- Birth Month -->
                            <select 
                                name="birth_month" 
                                class="block w-full px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                required
                            >
                                <option value="">Bulan</option>
                                @php
                                    $months = [
                                        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                                        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Ags',
                                        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                    ];
                                @endphp
                                @foreach($months as $key => $month)
                                    <option value="{{ $key }}" {{ old('birth_month') == $key ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>

                            <!-- Birth Year -->
                            <select 
                                name="birth_year" 
                                class="block w-full px-2 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                required
                            >
                                <option value="">Tahun</option>
                                @for($i = date('Y') - 18; $i >= 1900; $i--)
                                    <option value="{{ $i }}" {{ old('birth_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Gender Field -->
                    <div>
                        <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                <i class="fas fa-venus-mars text-gray-400 text-sm"></i>
                            </div>
                            <select 
                                id="gender" 
                                name="gender" 
                                class="block w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                                required
                            >
                                <option value="">Pilih jenis kelamin</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Row 5: Terms & Register Button -->
                <div class="space-y-3">
                    <!-- Terms and Conditions -->
                    <div class="flex items-center">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            required
                        >
                        <label for="terms" class="ml-2 block text-xs text-gray-700">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-500">Syarat & Ketentuan</a> dan <a href="#" class="text-blue-600 hover:text-blue-500">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-2 px-4 rounded-lg font-medium hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-[1.02] text-sm"
                    >
                        Submit
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="relative my-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="px-2 bg-white text-gray-500">Atau daftar dengan</span>
                </div>
            </div>

            <!-- Google OAuth Button -->
            <a 
                href="{{ route('google.redirect.register') }}" 
                class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 text-sm"
            >
                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Daftar dengan Google
            </a>

            <!-- Login Link -->
            <div class="text-center mt-3">
                <p class="text-xs text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center text-xs text-gray-500">
            <p>&copy; 2024 Auth System. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-50');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-50');
                });
            });
        });

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
