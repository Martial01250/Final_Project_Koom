<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Created_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $End_date = null;

    #[ORM\Column]
    private ?int $Nb_Employees_Desired = null;

    #[ORM\Column(length: 255)]
    private ?string $Short_description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Details = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $User_Like = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $Skill = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $Technology = [];

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Participate')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'Project', targetEntity: Comments::class)]
    private Collection $Id_Project;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->Id_Project = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->Created_date;
    }

    public function setCreatedDate(\DateTimeInterface $Created_date): self
    {
        $this->Created_date = $Created_date;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->Start_date;
    }

    public function setStartDate(\DateTimeInterface $Start_date): self
    {
        $this->Start_date = $Start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->End_date;
    }

    public function setEndDate(\DateTimeInterface $End_date): self
    {
        $this->End_date = $End_date;

        return $this;
    }

    public function getNbEmployeesDesired(): ?int
    {
        return $this->Nb_Employees_Desired;
    }

    public function setNbEmployeesDesired(int $Nb_Employees_Desired): self
    {
        $this->Nb_Employees_Desired = $Nb_Employees_Desired;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->Short_description;
    }

    public function setShortDescription(string $Short_description): self
    {
        $this->Short_description = $Short_description;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->Details;
    }

    public function setDetails(string $Details): self
    {
        $this->Details = $Details;

        return $this;
    }

    public function getUserLike(): array
    {
        return $this->User_Like;
    }

    public function setUserLike(?array $User_Like): self
    {
        $this->User_Like = $User_Like;

        return $this;
    }

    public function getSkill(): array
    {
        return $this->Skill;
    }

    public function setSkill(array $Skill): self
    {
        $this->Skill = $Skill;

        return $this;
    }

    public function getTechnology(): array
    {
        return $this->Technology;
    }

    public function setTechnology(array $Technology): self
    {
        $this->Technology = $Technology;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addParticipate($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeParticipate($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getIdProject(): Collection
    {
        return $this->Id_Project;
    }

    public function addIdProject(Comments $idProject): self
    {
        if (!$this->Id_Project->contains($idProject)) {
            $this->Id_Project->add($idProject);
            $idProject->setProject($this);
        }

        return $this;
    }

    public function removeIdProject(Comments $idProject): self
    {
        if ($this->Id_Project->removeElement($idProject)) {
            // set the owning side to null (unless already changed)
            if ($idProject->getProject() === $this) {
                $idProject->setProject(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
}
