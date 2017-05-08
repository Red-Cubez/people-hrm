<?php

namespace People\Repositories;

use People\Models\CompanyProject;
use People\Repositories\Interfaces\ICompanyProjectRepository;

class EloquentCompanyProjectRepository extends BaseRepository implements ICompanyProjectRepository {

    public function __construct()
    {
        parent::__construct(CompanyProject::class);
    }
}