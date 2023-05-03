<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\JobRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: JobRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['job:read'],   //o'qishga ruxsat
    ],
    denormalizationContext: [
        'groups' => ['job:write'],  //yozishga ruxsat
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'name' => 'partial', 'category' => 'exact'])]
#[ApiFilter(OrderFilter::class, properties: ['id', 'name'])]


class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['job:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['job:read', 'job:write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['job:read', 'job:write'])]
    private ?string $text = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['job:read', 'job:write'])]
    private ?int $person = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['job:read', 'job:write'])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(['job:read', 'job:write'])]
    private ?string $tel = null;

    #[ORM\ManyToOne(inversedBy: 'jobs')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['job:read', 'job:write'])]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPerson(): ?int
    {
        return $this->person;
    }

    public function setPerson(int $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

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
