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

    public function unreadChatCount()
    {
        if (!$this->isStaff) {
            $unreadChats = Chat::where('user_id', '!=', $this->id)
                ->where('is_read', false)
                ->get();
        } else {
            $staffId = $this->id; // Replace with the specific staff member's ID
            $sql = "SELECT * FROM chats WHERE staff_id = :staff_id AND is_read = 0";
            $unreadChats = DB::select($sql, ['staff_id' => $staffId]);
        }

        dd($unreadChats); // Add this line for debugging
    
        return [
            'count' => $unreadChats->count(),
            'chats' => $unreadChats,
        ];
    }
}
