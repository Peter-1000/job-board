<?php

namespace App\Dto;

class SaveCityDto
{
    private string $name;
    private int $stateId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getStateId(): int
    {
        return $this->stateId;
    }

    public function setStateId(int $stateId): self
    {
        $this->stateId = $stateId;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'state_id' => $this->stateId
        ];
    }
}
