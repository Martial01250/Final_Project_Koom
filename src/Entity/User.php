<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $Password = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Firstname = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $LastName = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Job = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Town = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Link_Git = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Link_LinkedIn = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $Skill = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $Technology = [];

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'users')]
    private Collection $Participate;

    #[ORM\OneToMany(mappedBy: 'Id_User', targetEntity: Comments::class)]
    private Collection $Id_User;

    public function __construct()
    {
        $this->Participate = new ArrayCollection();
        $this->Id_User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(?string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(?string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->Job;
    }

    public function setJob(?string $Job): self
    {
        $this->Job = $Job;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->Town;
    }

    public function setTown(?string $Town): self
    {
        $this->Town = $Town;

        return $this;
    }

    public function getLinkGit(): ?string
    {
        return $this->Link_Git;
    }

    public function setLinkGit(?string $Link_Git): self
    {
        $this->Link_Git = $Link_Git;

        return $this;
    }

    public function getLinkLinkedIn(): ?string
    {
        return $this->Link_LinkedIn;
    }

    public function setLinkLinkedIn(?string $Link_LinkedIn): self
    {
        $this->Link_LinkedIn = $Link_LinkedIn;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getSkill(): array
    {
        return $this->Skill;
    }

    public function setSkill(?array $Skill): self
    {
        $this->Skill = $Skill;

        return $this;
    }

    public function getTechnology(): array
    {
        return $this->Technology;
    }

    public function setTechnology(?array $Technology): self
    {
        $this->Technology = $Technology;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getParticipate(): Collection
    {
        return $this->Participate;
    }

    public function addParticipate(Project $participate): self
    {
        if (!$this->Participate->contains($participate)) {
            $this->Participate->add($participate);
        }

        return $this;
    }

    public function removeParticipate(Project $participate): self
    {
        $this->Participate->removeElement($participate);

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getIdUser(): Collection
    {
        return $this->Id_User;
    }

    public function addIdUser(Comments $idUser): self
    {
        if (!$this->Id_User->contains($idUser)) {
            $this->Id_User->add($idUser);
            $idUser->setIdUser($this);
        }

        return $this;
    }

    public function removeIdUser(Comments $idUser): self
    {
        if ($this->Id_User->removeElement($idUser)) {
            // set the owning side to null (unless already changed)
            if ($idUser->getIdUser() === $this) {
                $idUser->setIdUser(null);
            }
        }

        return $this;
    }
}
