<?php

namespace People\Repositories;

use People\Models\User;
use People\Repositories\Interfaces\IUserRepository;

class EloquentUserRepository extends BaseRepository implements IUserRepository {

    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where('provider_id', $user->id)->first()) {
            return $authUser;
        }

        //TODO figure out if this is required. all these properties
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider_id' => $user->id,
            'avatar' => $user->avatar,
            'provider' => $provider,
        ]);
    }
}