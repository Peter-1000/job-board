<?php

namespace App\Dto;

class SaveCategoryDto
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
