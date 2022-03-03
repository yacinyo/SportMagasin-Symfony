<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;


#[ApiResource()]
#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

   
    #[Assert\NotBlank(
        message: 'La référence est obligatoire')]
        #[Assert\Type('string')]
        #[Assert\Length(
            min: 2,
            max: 50)]
   #[ORM\Column(type: 'string', length: 200, nullable: true)]
     private $titre;
      
           
     #[Assert\NotNull (
        message:'le prix ne doit pas être nul'  
      )]
#[ORM\Column(type: 'integer', nullable: true)]
     private $prixBarre;
    

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $nouveau;

    #[Assert\NotBlank(
    message: 'La description est obligatoire')]
    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $description;
    
    #[ORM\Column(type: 'string', length: 200)]
    private $image;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'articles')]
    private $brand;

    #[ORM\ManyToMany(targetEntity: Catagory::class, inversedBy: 'articles')]
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrixBarre(): ?int
    {
        return $this->prixBarre;
    }

    public function setPrixBarre(?int $prixBarre): self
    {
        $this->prixBarre = $prixBarre;

        return $this;
    }

    public function getNouveau(): ?bool
    {
        return $this->nouveau;
    }

    public function setNouveau(?bool $nouveau): self
    {
        $this->nouveau = $nouveau;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Catagory[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Catagory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Catagory $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    
}
