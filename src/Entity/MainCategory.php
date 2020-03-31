<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MainCategoryRepository")
 */
class MainCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubCategory", mappedBy="mainCategory")
     */
    private $SubCategories;

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    public function __construct()
    {
        $this->SubCategories = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|SubCategory[]
     */
    public function getSubCategories(): Collection
    {
        return $this->SubCategories;
    }

    public function addSubCategory(SubCategory $subCategory): self
    {
        if (!$this->SubCategories->contains($subCategory)) {
            $this->SubCategories[] = $subCategory;
            $subCategory->setMainCategory($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): self
    {
        if ($this->SubCategories->contains($subCategory)) {
            $this->SubCategories->removeElement($subCategory);
            // set the owning side to null (unless already changed)
            if ($subCategory->getMainCategory() === $this) {
                $subCategory->setMainCategory(null);
            }
        }

        return $this;
    }
}
