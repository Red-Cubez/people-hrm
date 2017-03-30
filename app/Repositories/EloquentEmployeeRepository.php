<?php

namespace People\Repositories;

use People\Models\Employee;
use People\Repositories\Interfaces\IEmployeeRepository;

class EloquentEmployeeRepository extends BaseRepository implements IEmployeeRepository {

    public function __construct()
    {
        parent::__construct(Employee::class);
    }
}