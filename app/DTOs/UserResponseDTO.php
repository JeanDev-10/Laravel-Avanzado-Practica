<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class UserResponseDTO extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $email;
}
