<?php

namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'families')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, PlantBlueprint>
     */
    #[ORM\OneToMany(targetEntity: PlantBlueprint::class, mappedBy: 'family')]
    private Collection $plantBlueprints;

    public function __construct()
    {
        $this->plantBlueprints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, PlantBlueprint>
     */
    public function getPlantBlueprints(): Collection
    {
        return $this->plantBlueprints;
    }

    public function addPlantBlueprint(PlantBlueprint $plantBlueprint): static
    {
        if (!$this->plantBlueprints->contains($plantBlueprint)) {
            $this->plantBlueprints->add($plantBlueprint);
            $plantBlueprint->setFamily($this);
        }

        return $this;
    }

    public function removePlantBlueprint(PlantBlueprint $plantBlueprint): static
    {
        if ($this->plantBlueprints->removeElement($plantBlueprint)) {
            // set the owning side to null (unless already changed)
            if ($plantBlueprint->getFamily() === $this) {
                $plantBlueprint->setFamily(null);
            }
        }

        return $this;
    }
}
