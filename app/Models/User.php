<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'plant_id',
        'department',
        'license'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function permintaan(){
        return $this->hasMany(Permintaan::class);
    }

    public function plant(){
        return $this->belongsTo(Plant::class, 'plant_id');
    }

    public function feedback(){
        return $this->hasMany(Feedback::class);
    }

    public function chat(){
        return $this->hasMany(Chat::class);
    }

    public function getIsStaffAttribute()
    {
        // You need to add your logic here to determine if the user is a staff member.
        // For example, you can check the 'license' attribute.
        return $this->license === 'staff';
    }

    public function unreadChatCount()
    {
        if (!$this->isStaff) {
            // dd('IF branch executed');
            $unreadChats = Chat::where('user_id', '!=', $this->id)
                ->where('is_read', false)
                ->get();
        } else {
            // dd('ELSE branch executed');
            $unreadChats = Chat::where('staff_id', $this->id)
                ->where('is_read', false)
                ->get();
        }

        // dd($staffId); // Add this line for debugging
    
        return [
            'count' => $unreadChats->count(),
            'chats' => $unreadChats,
        ];
    }
}
