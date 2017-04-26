<?php

namespace People\Repositories;

use People\Models\EmployeeDepartment;
use People\Repositories\Interfaces\IEmployeeDepartmentRepository;

class EloquentEmployeeDepartmentRepository extends BaseRepository implements IEmployeeDepartmentRepository {

    public function __construct()
    {
        parent::__construct(EmployeeDepartment::class);
    }
}