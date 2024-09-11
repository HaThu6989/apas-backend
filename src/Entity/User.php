<?php

namespace App\Entity;

use App\Entity\Trait\DateTrait;
use App\Repository\UserRepository;
use App\Validator\Constraints as CustomAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use DateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, nullable: true, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[Ignore]
    #[ORM\Column(nullable: true)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $isAdmin = false;


    // #[Ignore]
    // #[ORM\OneToMany(
    //     mappedBy: 'user',
    //     targetEntity: CsvUpload::class,
    //     fetch: 'EAGER'
    // )]
    // private Collection $csvUploads;

    public ?string $plainPassword = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: 'boolean')]
    private $agreeTermsServiceMember = false;

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $nextEmail = null;

    // #[ORM\OneToMany(mappedBy: 'user', targetEntity: Company::class, fetch: 'EAGER')]
    // private Collection $companies;

    // #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    // private ?Company $lastCompanyUsed = null;

    #[ORM\Column()]
    private ?bool $oneTimePassword = false;

    public function __construct()
    {
        // $this->csvUploads = new ArrayCollection();
        // $this->companies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }


    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }


    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function getNextEmail(): ?string
    {
        return $this->nextEmail;
    }

    public function setNextEmail(?string $nextEmail): static
    {
        $this->nextEmail = $nextEmail;

        return $this;
    }


    // public function getCsvUploads(): Collection
    // {
    //     return $this->csvUploads;
    // }

    // public function addCsvUpload(CsvUpload $csvUpload): static
    // {
    //     if (!$this->csvUploads->contains($csvUpload)) {
    //         $this->csvUploads->add($csvUpload);
    //         $csvUpload->setUser($this);
    //     }

    //     return $this;
    // }

    // public function removeCsvUpload(CsvUpload $csvUpload): static
    // {
    //     if ($this->csvUploads->removeElement($csvUpload)) {
    //         // set the owning side to null (unless already changed)
    //         if ($csvUpload->getUser() === $this) {
    //             $csvUpload->setUser(null);
    //         }
    //     }

    //     return $this;
    // }

    public function isAgreeTermsServiceMember(): ?bool
    {
        return $this->agreeTermsServiceMember;
    }

    public function setAgreeTermsServiceMember(bool $agreeTermsServiceMember): static
    {
        $this->agreeTermsServiceMember = $agreeTermsServiceMember;

        return $this;
    }

    // public function getCompanies(): Collection
    // {
    //     return $this->companies;
    // }

    // public function addCompany(Company $company): static
    // {
    //     if (!$this->companies->contains($company)) {
    //         $this->companies->add($company);
    //         $company->setUser($this);
    //     }

    //     return $this;
    // }

    // public function removeCompany(Company $company): static
    // {
    //     if ($this->companies->removeElement($company)) {
    //         // set the owning side to null (unless already changed)
    //         if ($company->getUser() === $this) {
    //             $company->setUser(null);
    //         }
    //     }

    //     return $this;
    // }

    // public function getLastCompanyUsed(): ?Company
    // {
    //     return $this->lastCompanyUsed;
    // }

    // public function setLastCompanyUsed(?Company $lastCompanyUsed): static
    // {
    //     $this->lastCompanyUsed = $lastCompanyUsed;

    //     return $this;
    // }

    public function isOneTimePassword(): ?bool
    {
        return $this->oneTimePassword;
    }

    public function setOneTimePassword(?bool $oneTimePassword): static
    {
        $this->oneTimePassword = $oneTimePassword;

        return $this;
    }
}
