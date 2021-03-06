<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    // ! While the model is booting whe can register the model hooks (creating)
    // ! So every time before it persist into the database its going to call our function
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($model) {
            //  Get the primary key for the model
            $model->{$model->getKeyName()} = (string)Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship with Channel class
     * User has one Channel
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function channel() {
        return $this->hasOne(Channel::class);
    }
}
