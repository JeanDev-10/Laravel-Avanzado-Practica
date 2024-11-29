<?php

namespace App\Repository;

use App\DTOs\UserDTO;
use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Create a new class instance.
     */
    const RELATIONS=[
        'posts',
    ];
    public function __construct(User $user)
    {
       parent::__construct($user,self::RELATIONS);
    }



}
