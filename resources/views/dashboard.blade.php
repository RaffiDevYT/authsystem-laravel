<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Auth System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-8 w-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-semibold text-gray-900">Auth System</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        @if(Auth::user()->avatar)
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->avatar }}" alt="Profile">
                        @else
                            <div class="h-8 w-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">{{ substr(Auth::user()->full_name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->full_name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Selamat datang, {{ Auth::user()->full_name }}!
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Anda berhasil masuk ke sistem autentikasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information Cards -->
            <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Profile Info -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Informasi Profil</h3>
                                <p class="text-sm text-gray-500">{{ Auth::user()->full_name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-phone text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Kontak</h3>
                                <p class="text-sm text-gray-500">{{ Auth::user()->phone_number ?? 'Tidak disebutkan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-purple-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-info-circle text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Informasi Pribadi</h3>
                                <p class="text-sm text-gray-500">{{ Auth::user()->gender_label }}</p>
                                @if(Auth::user()->birth_year && Auth::user()->birth_month && Auth::user()->birth_day)
                                    <p class="text-xs text-gray-400">{{ Auth::user()->formatted_birth_date }} ({{ Auth::user()->age }} tahun)</p>
                                @else
                                    <p class="text-xs text-gray-400">Tanggal lahir tidak disebutkan</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login Method -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 {{ Auth::user()->isGoogleUser() ? 'bg-red-500' : 'bg-green-500' }} rounded-md flex items-center justify-center">
                                    @if(Auth::user()->isGoogleUser())
                                        <i class="fab fa-google text-white text-sm"></i>
                                    @else
                                        <i class="fas fa-envelope text-white text-sm"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Metode Login</h3>
                                <p class="text-sm text-gray-500">
                                    {{ Auth::user()->isGoogleUser() ? 'Google OAuth' : 'Email & Password' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Status -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <i class="fas fa-shield-check text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Status Akun</h3>
                                <p class="text-sm text-gray-500">
                                    @if(Auth::user()->email_verified_at)
                                        <span class="text-green-600">Terverifikasi</span>
                                    @else
                                        <span class="text-yellow-600">Belum Terverifikasi</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Features -->
            <div class="mt-6 bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        Fitur yang Tersedia
                    </h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-lock text-blue-600 mr-3"></i>
                            <span class="text-sm text-gray-700">Autentikasi Aman</span>
                        </div>
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <i class="fab fa-google text-green-600 mr-3"></i>
                            <span class="text-sm text-gray-700">Login dengan Google</span>
                        </div>
                        <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                            <i class="fas fa-database text-purple-600 mr-3"></i>
                            <span class="text-sm text-gray-700">Database Integration</span>
                        </div>
                        <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                            <i class="fas fa-mobile-alt text-yellow-600 mr-3"></i>
                            <span class="text-sm text-gray-700">Responsive Design</span>
                        </div>
                        <div class="flex items-center p-3 bg-red-50 rounded-lg">
                            <i class="fas fa-shield-alt text-red-600 mr-3"></i>
                            <span class="text-sm text-gray-700">Session Management</span>
                        </div>
                        <div class="flex items-center p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-cog text-indigo-600 mr-3"></i>
                            <span class="text-sm text-gray-700">Easy Configuration</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-sm text-gray-500">
                <p>&copy; 2024 Auth System. Dibuat dengan Laravel dan Tailwind CSS.</p>
            </div>
        </div>
    </footer>
</body>
</html>
