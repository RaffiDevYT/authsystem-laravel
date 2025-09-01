<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 p-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 15px;">
    
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; pointer-events: none;">
        <div style="position: absolute; top: -80px; left: -80px; width: 200px; height: 200px; background: white; border-radius: 50%;"></div>
        <div style="position: absolute; top: -40px; right: -40px; width: 150px; height: 150px; background: white; border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -60px; left: -60px; width: 180px; height: 180px; background: white; border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -20px; right: -20px; width: 100px; height: 100px; background: white; border-radius: 50%;"></div>
    </div>

    <!-- Main Container -->
    <div style="max-width: 500px; margin: 0 auto; position: relative; z-index: 1;">
        
        <!-- Email Card -->
        <div style="background: white; border-radius: 20px; box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25); overflow: hidden; margin: 30px 0;">
            
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%); padding: 30px 25px; text-align: center; position: relative; overflow: hidden;">
                <!-- Header Pattern -->
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.2;">
                    <div style="position: absolute; top: -15px; left: -15px; width: 80px; height: 80px; background: white; border-radius: 50%;"></div>
                    <div style="position: absolute; top: -8px; right: -8px; width: 60px; height: 60px; background: white; border-radius: 50%;"></div>
                    <div style="position: absolute; bottom: -12px; left: 50%; transform: translateX(-50%); width: 50px; height: 50px; background: white; border-radius: 50%;"></div>
                </div>
                
                <!-- Logo and Title -->
                <div style="position: relative; z-index: 1;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.3); margin-bottom: 18px; box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);">
                        <span style="font-size: 28px;">🔐</span>
                    </div>
                    <h1 style="color: white; font-size: 26px; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -0.5px;">Auth System</h1>
                    <p style="color: rgba(255, 255, 255, 0.9); font-size: 16px; font-weight: 500; margin: 0;">Reset Password</p>
                </div>
            </div>

            <!-- Content -->
            <div style="padding: 30px 25px; background: white;">
                
                <!-- Greeting -->
                <div style="text-align: center; margin-bottom: 24px;">
                    <h2 style="color: #1f2937; font-size: 22px; font-weight: 700; margin: 0 0 12px 0;">
                        Halo {{ $user->first_name }}! 👋
                    </h2>
                    <p style="color: #6b7280; font-size: 14px; line-height: 1.5; margin: 0;">
                        Kami menerima permintaan reset password untuk akun Anda
                    </p>
                </div>

                <!-- CTA Button -->
                <div style="text-align: center; margin-bottom: 24px;">
                    <a href="{{ $resetUrl }}" 
                       style="display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; padding: 14px 28px; border-radius: 14px; font-weight: 600; font-size: 16px; text-decoration: none; box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3); transition: all 0.3s ease;">
                        Reset Password Sekarang
                    </a>
                </div>

                <!-- Alternative Link -->
                <div style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 14px; padding: 20px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                    <div style="display: flex; align-items: center; margin-bottom: 12px;">
                        <div>
                            <h3 style="color: #1f2937; font-weight: 600; font-size: 14px; margin: 0 0 3px 0;">Alternatif Manual</h3>
                            <p style="color: #6b7280; font-size: 12px; margin: 0;">Copy link berikut ke browser</p>
                        </div>
                    </div>
                    <div style="background: white; border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px;">
                        <a href="{{ $resetUrl }}" style="color: #2563eb; font-size: 12px; word-break: break-all; font-family: monospace; text-decoration: none;">
                            {{ $resetUrl }}
                        </a>
                    </div>
                </div>

                <!-- Security Warning -->
                <div style="background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); border-radius: 14px; padding: 20px; margin-bottom: 20px; border: 1px solid #fecaca;">
                    <div style="display: flex; align-items: center; margin-bottom: 12px;">
                        <div>
                            <h3 style="color: #991b1b; font-weight: 600; font-size: 14px; margin: 0 0 3px 0;">Penting untuk Diperhatikan</h3>
                            <p style="color: #b91c1c; font-size: 12px; margin: 0;">Keamanan akun Anda</p>
                        </div>
                    </div>
                    <div style="space-y: 8px;">
                            <div style="display: flex; align-items: center; color: #991b1b; font-size: 12px;">
                             <div style="width: 6px; height: 6px; background: #f87171; border-radius: 50%; margin-right: 8px;"></div>
                             Link berlaku selama <strong style="margin-left: 3px;">5 menit</strong>
                         </div>
                        <div style="display: flex; align-items: center; color: #991b1b; font-size: 12px;">
                            <div style="width: 6px; height: 6px; background: #f87171; border-radius: 50%; margin-right: 8px;"></div>
                            Jangan bagikan ke <strong style="margin-left: 3px;">siapapun</strong>
                        </div>
                        <div style="display: flex; align-items: center; color: #991b1b; font-size: 12px;">
                            <div style="width: 6px; height: 6px; background: #f87171; border-radius: 50%; margin-right: 8px;"></div>
                            Abaikan jika <strong style="margin-left: 3px;">tidak meminta</strong>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius: 14px; padding: 20px; margin-bottom: 20px; border: 1px solid #bfdbfe;">
                    <div style="display: flex; align-items: center;">
                        <div>
                            <h3 style="color: #1e40af; font-weight: 600; font-size: 14px; margin: 0 0 3px 0;">Tips & Trik</h3>
                            <p style="color: #1e40af; font-size: 12px; margin: 0;">
                                Jika tombol tidak berfungsi, copy-paste URL di atas ke browser Anda
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div style="background: linear-gradient(135deg, #1f2937 0%, #374151 100%); text-align: center; padding: 20px 25px;">
                <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                    <div style="width: 6px; height: 6px; background: #6366f1; border-radius: 50%; margin: 0 6px;"></div>
                    <p style="color: #9ca3af; font-size: 11px; font-weight: 500; margin: 0 0 6px 0;">Email Otomatis</p>
                    <div style="width: 6px; height: 6px; background: #6366f1; border-radius: 50%; margin: 0 6px;"></div>
                </div>
                <p style="color: #9ca3af; font-size: 11px; margin: 0 0 6px 0;">Jangan balas email ini</p>
                <p style="color: #6b7280; font-size: 11px; margin: 0;">© {{ date('Y') }} Auth System • All rights reserved</p>
            </div>
        </div>
    </div>
</body>
</html>
