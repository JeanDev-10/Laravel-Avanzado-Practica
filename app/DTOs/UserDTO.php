<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $name;
    public string $email;
    public ?string $password; // Opcional
    public static function fromRequest(array $validated): self
    {
        return new self([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
    }


}
