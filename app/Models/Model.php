<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

class Model extends BaseModel
{
    use HasFactory;

    public $incrementing = false;

    /*
     * When you have an error about mass assignment
     * */
    protected $guarded = [];

    // ! While the model is booting whe can register the model hooks (creating)
    // ! So every time before it persist into the database its going to call our function
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($model) {
            //  Get the primary key for the model
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
