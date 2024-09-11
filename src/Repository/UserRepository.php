<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\User;
use App\Model\UserSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Function used in the login process, be careful when changiing it
     */
    public function loadUserByIdentifier(string $codeOrEmail): ?User
    {
        $codeOrEmail = trim($codeOrEmail);
        $user = null;
        $entityManager = $this->getEntityManager();

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $codeOrEmail]);

        // if (intval($codeOrEmail, 10)  && !strpos((string)$codeOrEmail, "@")) {
        //     $company = $entityManager->getRepository(Company::class)->findOneBy(['membershipCode' => $codeOrEmail]);
        //     if ($company) {
        //         $user = $company->getUser();
        //     }
        // } else {
        //     $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $codeOrEmail]);
        //     $company = null;
        // }

        if ($user) {
            // $user->setLastCompanyUsed($company);
            $entityManager->flush();
        }

        return $user;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}
