<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubCategoryRepository")
 */
class SubCategory
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubSubCategory", mappedBy="subCategory")
     */
    private $SubSubCategories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MainCategory", inversedBy="SubCategories")
     */
    private $mainCategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="subCategory")
     */
    private $Products;

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->title . ' : ' . $this->mainCategory . PHP_EOL;
    }

    public function __construct()
    {
        $this->SubSubCategories = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->Products = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     * @return Collection|SubSubCategory[]
     */
    public function getSubSubCategories(): Collection
    {
        return $this->SubSubCategories;
    }

    public function addSubSubCategory(SubSubCategory $subSubCategory): self
    {
        if (!$this->SubSubCategories->contains($subSubCategory)) {
            $this->SubSubCategories[] = $subSubCategory;
            $subSubCategory->setSubCategory($this);
        }

        return $this;
    }

    public function removeSubSubCategory(SubSubCategory $subSubCategory): self
    {
        if ($this->SubSubCategories->contains($subSubCategory)) {
            $this->SubSubCategories->removeElement($subSubCategory);
            // set the owning side to null (unless already changed)
            if ($subSubCategory->getSubCategory() === $this) {
                $subSubCategory->setSubCategory(null);
            }
        }

        return $this;
    }

    public function getMainCategory(): ?MainCategory
    {
        return $this->mainCategory;
    }

    public function setMainCategory(?MainCategory $mainCategory): self
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->Products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->Products->contains($product)) {
            $this->Products[] = $product;
            $product->setSubCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->Products->contains($product)) {
            $this->Products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getSubCategory() === $this) {
                $product->setSubCategory(null);
            }
        }

        return $this;
    }
}
