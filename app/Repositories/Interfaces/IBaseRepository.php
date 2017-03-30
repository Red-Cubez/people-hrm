<?php

namespace People\Repositories\Interfaces;

interface IBaseRepository{

    public function all();

    public function find($id);

    public function create($input);

    public function firstOrCreate(array $attributes);

    public static function firstOrNew(array $attributes);

    public static function updateOrCreate(array $attributes, array $values = []);

    public function query();

    public function fill(array $attributes);
}