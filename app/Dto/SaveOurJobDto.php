<?php

namespace App\Dto;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;

class SaveOurJobDto
{
    private string $title;
    private string $description;
    private string $company_name;
    private float $salary;
    private float $salary_max;
    private bool $is_remote;
    private string $job_type;
    private string $status;
    private ?string $published_at;
    private array $languages;
    private array $categories;
    private array $cities;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCompanyName(): string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;
        return $this;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;
        return $this;
    }

    public function isRemote(): bool
    {
        return $this->is_remote;
    }

    public function setIsRemote(bool $is_remote): self
    {
        $this->is_remote = $is_remote;
        return $this;
    }

    public function getJobType(): string
    {
        return $this->job_type;
    }

    public function setJobType(string $job_type): self
    {
        $this->job_type = $job_type;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getPublishedAt(): ?string
    {
        return $this->published_at;
    }

    public function setPublishedAt(?string $published_at): self
    {
        $this->published_at = $published_at;
        return $this;
    }

    public function getLanguages(): array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $this->languages = $languages;
        return $this;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function getCities(): array
    {
        return $this->cities;
    }

    public function setCities(array $cities): self
    {
        $this->cities = $cities;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'company_name' => $this->getCompanyName(),
            'salary' => $this->getSalary(),
            'is_remote' => $this->isRemote(),
            'job_type' => $this->getJobType(),
            'status' => $this->getStatus(),
            'published_at' => $this->getPublishedAt(),
            'languages' => $this->getLanguages(),
            'categories' => $this->getCategories(),
            'cities' => $this->getCities(),
        ];
    }

    public function relations(): array
    {
        return [
            'languages' => $this->getLanguages(),
            'categories' => $this->getCategories(),
            'cities' => $this->getCities(),
        ];
    }
}
