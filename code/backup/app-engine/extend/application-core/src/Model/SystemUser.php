<?php

namespace DevEngine\Core\Model;

use \Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use DevEngine\Core\Traits\RoleHas;


/**
 * Class SystemUser
 * @package DevEngine\Core\Model
 */
class SystemUser extends User implements JWTSubject
{

    use RoleHas;
    use Notifiable;


    protected $table = 'system_user';

    protected $primaryKey = 'user_id';

    protected $fillable = ['username', 'password'];


    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            return;
        }
        $this->attributes['password'] = \Hash::make($value);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($data) {
            $data->roles()->detach();
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthIdentifierName()
    {
        return 'user_id';
    }


}