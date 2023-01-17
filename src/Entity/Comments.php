<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Created_Date = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $User_comment_like = [];

    #[ORM\ManyToOne(inversedBy: 'Id_Project')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $Project = null;

    #[ORM\ManyToOne(inversedBy: 'Id_User')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Id_User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->Created_Date;
    }

    public function setCreatedDate(\DateTimeInterface $Created_Date): self
    {
        $this->Created_Date = $Created_Date;

        return $this;
    }

    public function getUserCommentLike(): array
    {
        return $this->User_comment_like;
    }

    public function setUserCommentLike(?array $User_comment_like): self
    {
        $this->User_comment_like = $User_comment_like;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->Project;
    }

    public function setProject(?Project $Project): self
    {
        $this->Project = $Project;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->Id_User;
    }

    public function setIdUser(?User $Id_User): self
    {
        $this->Id_User = $Id_User;

        return $this;
    }
}
