<?php

namespace People\Repositories;

use People\Models\ClientProject;
use People\Repositories\Interfaces\IClientProjectRepository;

class EloquentClientProjectRepository extends BaseRepository implements IClientProjectRepository {

    public function __construct()
    {
        parent::__construct(ClientProject::class);
    }
}