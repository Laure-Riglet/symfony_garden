<?php

namespace App\Entity;

use App\Repository\PlantBlueprintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantBlueprintRepository::class)]
class PlantBlueprint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $species = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $sun_requirements = [];

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $watering_needs = null;

    #[ORM\Column]
    private array $germination_months = [];

    #[ORM\Column]
    private array $planting_months = [];

    #[ORM\Column]
    private array $flowering_months = [];

    #[ORM\Column]
    private array $harvest_months = [];

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $hardiness = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne]
    private ?User $createdBy = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $updatedBy = null;

    /**
     * @var Collection<int, TaskBlueprint>
     */
    #[ORM\ManyToMany(targetEntity: TaskBlueprint::class, mappedBy: 'plantBlueprint')]
    private Collection $taskBlueprints;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class)]
    private Collection $tags;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'plantBlueprints')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Family $family = null;

    public function __construct()
    {
        $this->taskBlueprints = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): static
    {
        $this->species = $species;

        return $this;
    }

    public function getSunRequirements(): array
    {
        return $this->sun_requirements;
    }

    public function setSunRequirements(array $sun_requirements): static
    {
        $this->sun_requirements = $sun_requirements;

        return $this;
    }

    public function getWateringNeeds(): ?int
    {
        return $this->watering_needs;
    }

    public function setWateringNeeds(int $watering_needs): static
    {
        $this->watering_needs = $watering_needs;

        return $this;
    }

    public function getGerminationMonths(): array
    {
        return $this->germination_months;
    }

    public function setGerminationMonths(array $germination_months): static
    {
        $this->germination_months = $germination_months;

        return $this;
    }

    public function getPlantingMonths(): array
    {
        return $this->planting_months;
    }

    public function setPlantingMonths(array $planting_months): static
    {
        $this->planting_months = $planting_months;

        return $this;
    }

    public function getFloweringMonths(): array
    {
        return $this->flowering_months;
    }

    public function setFloweringMonths(array $flowering_months): static
    {
        $this->flowering_months = $flowering_months;

        return $this;
    }

    public function getHarvestMonths(): array
    {
        return $this->harvest_months;
    }

    public function setHarvestMonths(array $harvest_months): static
    {
        $this->harvest_months = $harvest_months;

        return $this;
    }

    public function getHardiness(): ?int
    {
        return $this->hardiness;
    }

    public function setHardiness(int $hardiness): static
    {
        $this->hardiness = $hardiness;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): static
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return Collection<int, TaskBlueprint>
     */
    public function getTaskBlueprints(): Collection
    {
        return $this->taskBlueprints;
    }

    public function addTaskBlueprint(TaskBlueprint $taskBlueprint): static
    {
        if (!$this->taskBlueprints->contains($taskBlueprint)) {
            $this->taskBlueprints->add($taskBlueprint);
            $taskBlueprint->addPlantBlueprint($this);
        }

        return $this;
    }

    public function removeTaskBlueprint(TaskBlueprint $taskBlueprint): static
    {
        if ($this->taskBlueprints->removeElement($taskBlueprint)) {
            $taskBlueprint->removePlantBlueprint($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

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

    public function getFamily(): ?Family
    {
        return $this->family;
    }

    public function setFamily(?Family $family): static
    {
        $this->family = $family;

        return $this;
    }
}
