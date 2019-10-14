<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'id';
    /**
     * @var array
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'is_active',
        'address',
        'mobile_number',
        'landline_number',
        'profile_picture',
        'location_id',
    ];

    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    const SUPER_ADMIN_TYPE = 0;
    const ADMIN_TYPE = 1;
    const EDITOR_TYPE = 2;
    const USER_TYPE = 3;

    public function isSuperAdmin()    {
        return $this->role === self::SUPER_ADMIN_TYPE;
    }

    public function isAdmin()    {
        return $this->role === self::ADMIN_TYPE;
    }

    public function isEditor()    {
        return $this->role === self::EDITOR_TYPE;
    }

    public function isUser()    {
        return $this->role === self::USER_TYPE;
    }



    public function store($inputs, $id = null)
    {
        if($id)
        {
            $users = $this->findOrFail($id);
            return $users->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userRoleOptions()
    {
        return [
            null => '-- Select Role --',
            1 => 'Admin',
            2 => 'Editor',
            3 => 'User',
        ];
    }


//    public function toggleIsActive()
//    {
//        $this->is_active= !$this->is_active;
//        return $this;
//    }

    /**
     * @param $role
     * @return bool
     */
//    public function verifyAdmin($role)
//    {
//         return $this->role != 0;
//
//    }



//    public function proposals()
//    {
//        return $this->hasMany(Proposal::class);
//    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
