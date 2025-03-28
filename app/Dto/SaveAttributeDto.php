<?php

namespace App\Dto;

class SaveAttributeDto
{
    private int $ourJobId;
    private mixed $type;
    private mixed $value;

    /**
     * @return int
     */
    public function getOurJobId(): int
    {
        return $this->ourJobId;
    }

    public function setOurJobId(int $ourJobId): self
    {
        $this->ourJobId = $ourJobId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType(): mixed
    {
        return $this->type;
    }

    public function setType(mixed $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'our_job_id' => $this->getOurJobId(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
        ];
    }
}
