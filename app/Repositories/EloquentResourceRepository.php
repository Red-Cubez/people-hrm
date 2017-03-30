<?php

namespace People\Repositories;

use People\Models\Resource;
use People\Repositories\Interfaces\IResourceRepository;

class EloquentResourceRepository extends BaseRepository implements IResourceRepository {

    public function __construct()
    {
        parent::__construct(Resource::class);
    }
}