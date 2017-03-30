<?php

namespace People\Repositories;

use People\Repositories\Interfaces\IBaseRepository;

abstract class BaseRepository implements IBaseRepository{

    protected static $baseModel;

    public function __construct($model)
    {
        static::$baseModel = $model;
    }

    public function all()
    {
        //need to put Static because its being accessed statically
        $model = static::$baseModel;
        return $model::all();
    }

    public function find($id)
    {
        $model = static::$baseModel;
        return $model::find($id);
    }

    public function create($input)
    {
        $model = static::$baseModel;
        return $model::create($input);
    }


    public function firstOrCreate(array $attributes)
    {
        $model = static::$baseModel;
        return $model::firstOrCreate($attributes);
    }

    public static function firstOrNew(array $attributes)
    {
        $model = static::$baseModel;
        return $model::firstOrNew($attributes);
    }


    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $model = static::$baseModel;
        return $model::updateOrCreate($attributes, $values);
    }

    public function query()
    {
        $model = static::$baseModel;
        return $model::query();
    }

    public function fill(array $attributes)
    {
        $model = static::$baseModel;
        return $model::fill($attributes);
    }
}