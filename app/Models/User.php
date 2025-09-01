<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'birth_day',
        'birth_month',
        'birth_year',
        'gender',
        'google_id',
        'google_token',
        'google_refresh_token',
        'avatar',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'google_refresh_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_day' => 'integer',
            'birth_month' => 'integer',
            'birth_year' => 'integer',
            'password' => 'hashed',
        ];
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    /**
     * Check if user has password set
     */
    public function hasPassword(): bool
    {
        return !empty($this->password);
    }

    /**
     * Check if user is Google OAuth user
     */
    public function isGoogleUser(): bool
    {
        return !empty($this->google_id);
    }

    /**
     * Get user's age
     */
    public function getAgeAttribute(): ?int
    {
        if (!$this->birth_year || !$this->birth_month || !$this->birth_day) {
            return null;
        }
        
        $birthDate = \Carbon\Carbon::createFromDate($this->birth_year, $this->birth_month, $this->birth_day);
        return $birthDate->diffInYears(now());
    }

    /**
     * Get formatted birth date
     */
    public function getFormattedBirthDateAttribute(): string
    {
        if (!$this->birth_year || !$this->birth_month || !$this->birth_day) {
            return 'Tidak disebutkan';
        }
        
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return $this->birth_day . ' ' . $months[$this->birth_month] . ' ' . $this->birth_year;
    }

    /**
     * Get gender label
     */
    public function getGenderLabelAttribute(): string
    {
        return match($this->gender) {
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
            'other' => 'Lainnya',
            default => 'Tidak disebutkan'
        };
    }
}
