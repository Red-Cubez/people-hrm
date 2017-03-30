<?php

namespace People\Repositories;

use People\Models\Address;
use People\Repositories\Interfaces\IAddressRepository;

class EloquentAddressRepository extends BaseRepository implements IAddressRepository {

    public function __construct()
    {
        parent::__construct(Address::class);
    }
}