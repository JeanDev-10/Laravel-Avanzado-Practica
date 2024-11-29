<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class PostDTO extends DataTransferObject
{
    public string $title;
    public string $content;
    public int $user_id;

    public static function fromRequest(array $validated): self
    {
        return new self([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $validated['user_id'],
        ]);
    }

}
