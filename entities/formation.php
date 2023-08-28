<?php

class Formation {
  /*  private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $startDate;
    private ?string $endDate;
    private ?int $typeId; // Foreign key referencing Type entity
    */
    public function __construct(
        private ?int $id = null,
        private ?string $title = null,
        private ?string $description = null,
        private ?string $startDate = null,
        private ?string $endDate = null,
        private ?int $typeId = null
     ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->typeId = $typeId;
    }
    
    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $title): void {
        $this->title = $title;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getStartDate(): ?string {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): void {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?string {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): void {
        $this->endDate = $endDate;
    }

    public function getTypeId(): ?int {
        return $this->typeId;
    }

    public function setTypeId(?int $typeId): void {
        $this->typeId = $typeId;
    }
}
