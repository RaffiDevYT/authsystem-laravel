<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Auth System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    </head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="min-h-screen flex flex-col">
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
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 px-4 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:from-blue-600 hover:to-indigo-700 transition-all duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
                </nav>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center p-4">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Hero Section -->
                <div class="mb-12">
                    <div class="mx-auto h-24 w-24 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-4xl"></i>
                    </div>
                    <h1 class="text-5xl font-bold text-gray-900 mb-6">
                        Selamat Datang di
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-600">
                            Auth System
                                </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                        Sistem autentikasi lengkap dengan Laravel yang mendukung login email/password dan Google OAuth. 
                        Dibangun dengan Tailwind CSS untuk UI yang modern dan responsif.
                    </p>
                    <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk
                </a>
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar
                </a>
            </div>
                </div>

                <!-- Features Section -->
                <div id="features" class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-lock text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Autentikasi Aman</h3>
                        <p class="text-gray-600">
                            Sistem login yang aman dengan validasi input, password hashing, dan session management.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fab fa-google text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Google OAuth</h3>
                        <p class="text-gray-600">
                            Login mudah dengan akun Google tanpa perlu mengingat password tambahan.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="h-16 w-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Responsive Design</h3>
                        <p class="text-gray-600">
                            Interface yang responsif dan modern menggunakan Tailwind CSS untuk semua device.
                        </p>
                    </div>
                </div>

                <!-- Tech Stack -->
                <div class="bg-white p-8 rounded-2xl shadow-lg mb-12">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Teknologi yang Digunakan</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="h-16 w-16 bg-red-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fab fa-laravel text-red-600 text-2xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Laravel</p>
                        </div>
                        <div class="text-center">
                            <div class="h-16 w-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fab fa-php text-blue-600 text-2xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">PHP 8.2+</p>
                        </div>
                        <div class="text-center">
                            <div class="h-16 w-16 bg-cyan-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fab fa-css3-alt text-cyan-600 text-2xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Tailwind CSS</p>
                        </div>
                        <div class="text-center">
                            <div class="h-16 w-16 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-database text-yellow-600 text-2xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">MySQL</p>
                        </div>
                    </div>
        </div>

                <!-- CTA Section -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-8 text-white">
                    <h3 class="text-2xl font-semibold mb-4">Siap untuk Memulai?</h3>
                    <p class="text-blue-100 mb-6">
                        Login sekarang dan rasakan kemudahan sistem autentikasi yang aman dan modern.
                    </p>
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200 inline-flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                    </a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-500">&copy; 2024 Auth System. Dibuat oleh <a href="https://www.instagram.com/rafii.ath/" class="text-blue-600 hover:text-blue-500">Raffi Athallah.1602</a></p>
            </div>
        </footer>
    </div>
    </body>
</html>
