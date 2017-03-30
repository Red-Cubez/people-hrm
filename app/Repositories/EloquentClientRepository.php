<?php

namespace People\Repositories;

use People\Models\Client;
use People\Repositories\Interfaces\IClientRepository;

class EloquentClientRepository extends BaseRepository implements IClientRepository {

    public function __construct()
    {
        parent::__construct(Client::class);
    }
}