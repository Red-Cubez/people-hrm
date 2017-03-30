<?php

namespace People\Repositories;

use People\Models\Project;
use People\Repositories\Interfaces\IProjectRepository;

class EloquentProjectRepository extends BaseRepository implements IProjectRepository {

    public function __construct()
    {
        parent::__construct(Project::class);
    }
}