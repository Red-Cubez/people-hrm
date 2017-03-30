<?php

namespace People\Repositories;

use People\Models\Company;
use People\Repositories\Interfaces\ICompanyRepository;

class EloquentCompanyRepository extends BaseRepository implements ICompanyRepository {

    public function __construct()
    {
        parent::__construct(Company::class);
    }
}