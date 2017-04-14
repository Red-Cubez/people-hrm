<?php

namespace People\Repositories;

use People\Models\Department;
use People\Repositories\Interfaces\IDepartmentRepository;

class EloquentDepartmentRepository extends BaseRepository implements IDepartmentRepository {

    public function __construct()
    {
        parent::__construct(Department::class);
    }
}