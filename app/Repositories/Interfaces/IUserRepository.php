<?php

namespace People\Repositories\Interfaces;



interface IUserRepository extends IBaseRepository {
    public function findOrCreateUser($user, $provider);
}