<?php

namespace App\Models;

use App\Notifications\CustomVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
  

    public function getName()
    {
        return $this->firstname . " " . $this->lastname;
    }
 
 /*       public function hasVerifiedEmail()
        {
                return $this->email_verified_at !== null;

        }
        
        public function markEmailAsVerified()
        {
            $this->email_verified_at = now();
            $this->save();
        }
        
        public function sendEmailVerificationNotification()
        {
            $this->notify(new CustomVerifyEmail);

        }
        
        public function getEmailForVerification()
        {
            return $this->email;

        }  */
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'role',
        'password',
        'userable_type','userable_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'password' => 'hashed',
        ];
    }
}
