<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /*
     * use mongolab connection
     */
    protected $connection = 'mongolab';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role_id', 'billing_address', 'city', 'province', 'country', 'postal_code', 'phone', 'gender', 'dob', 'plan'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The default values for some attributes
     *
     * @var array
     */
    protected $attributes = array(
        'role_id' => 1,
        'plan' => 'lite',
    );
}
