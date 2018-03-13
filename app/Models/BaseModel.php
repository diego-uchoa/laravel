<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {

            static::setNullWhenEmpty($model);
            return true;

        });

        static::updating(function($model) {

            static::setNullWhenEmpty($model);
            return true;

        });
    }

    private static function setNullWhenEmpty($model)
    {
        foreach ($model->toArray() as $name => $value) {
            //if (empty($value)) {
            if(strlen($value) == 0) {
                $model->{$name} = null;
            }
        }
    }
}