<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Avatar;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['role'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function batch() {
        return $this->hasOne(Batch::class, 'id', 'batch_id');
    }

    public function isSuperAdmin() {
        return $this->role->id == 1 ? true : false;
    }

    public function isAdmin() {
        return $this->role->id == 2 ? true : false;
    }

    public function isVendor() {
        return $this->role->id == 3 ? true : false;
    }

    public function isUser() {
        return $this->role->id == 3 ? true : false;
    }

    public function getProfilePictureAttribute(): string {
        if (!$this->attributes['image']) {
            $email = $this->attributes['email'];
            $gravemail = md5(strtolower(trim($email)));
            $gravsrc = "http://www.gravatar.com/avatar/" . $gravemail;
            $gravcheck = "http://www.gravatar.com/avatar/" . $gravemail . "?d=404";
            $response = get_headers($gravcheck);
            if ($response[7] != "HTTP/1.1 404 Not Found") {
                return $gravsrc;
            } else {
                return Avatar::create($this->attributes['name'])->toBase64();
            }
        } else {
            return asset('/uploads/users/' . $this->attributes['image']);
        }
    }

    public static function allSuperAdmins() {
        return User::where('role_id', 1)->get();
    }

    public static function allAdmins() {
        return User::where('role_id', 2)->get();
    }

    public static function allVendors() {
        return User::where('role_id', 3)->get();
    }

    public static function allUsers() {
        return User::where('role_id', 4)->get();
    }
}
