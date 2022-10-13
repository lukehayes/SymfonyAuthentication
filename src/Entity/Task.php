<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Task name must be at least {{ limit }} characters long',
        maxMessage: 'Your task cannot be longer than {{ limit }} characters',
    )]
    #[ORM\Column(length: 255)]
    private ?string $task = null;

    #[ORM\Column]
    private ?bool $completed = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
