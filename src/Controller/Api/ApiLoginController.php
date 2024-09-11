<?php

namespace App\Controller\Api;

use App\DTO\JsonResponseDTO;
use App\Entity\Company;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Helper\UserHelper;

#[Route('/api/login')]
class ApiLoginController extends AbstractController
{
    public function __construct(
        // private UserHelper $userHelper,
    )
    {
        // ...
    }

    #[Route('/logout', name: 'api_form_logout')]
    public function logoutForm(): Response
    {
        return $this->json([]);
    }

    #[Route('', name: 'api_form_login')]
    public function loginForm(): Response
    {
        return $this->json([]);
    }

    #[Route('/json', methods: ['POST'], name: 'api_login')]
    public function index(): Response
    {
        return $this->json([]);
    }

    // #[Route('/identifier', methods: ['POST'], name: 'api_identifier')]
    // public function checkIdentifier(Request $request, EntityManagerInterface $em): JsonResponse
    // {
    //     $data = json_decode($request->getContent(), true);
    //     $membershipCode = $data['membershipCode'] ?? null;


    //     // if (intval($membershipCode, 10) && !strpos((string)$membershipCode, "@")) {
    //     //     $company = $em->getRepository(Company::class)->findOneBy(['membershipCode' => intval($membershipCode, 10)]);
    //     //     if (is_null($company)) {
    //     //         $dto = new JsonResponseDTO('200', 'error', ['Aucun utilisateur avec cet identifiant n\'a été trouvé.']);
    //     //         return new JsonResponse($dto->toArray(), 200);
    //     //     }
    //     //     $user = $company->getUser();
    //     //     // check if the user is not someone who didn't finished registering process
    //     //     if ($user && $user->getEmail() === null && !$user->isIsVerified()) {
    //     //         $user = null;
    //     //     }

    //     //     // account not created yet
    //     //     if (is_null($user)) {
    //     //         $dto = new JsonResponseDTO('200', 'ok', ['isRegistered' => false, 'companyName' => $company->getCompanyName()]);
    //     //         return new JsonResponse($dto->toArray(), 200);
    //     //     }
    //     // } else {
    //     //     $user = $em->getRepository(User::class)->findOneBy(['email' => $membershipCode]);
    //     // }

    //     if (is_null($user)) {
    //         $dto = new JsonResponseDTO('200', 'error', ['Aucun utilisateur avec cet identifiant n\'a été trouvé.']);
    //         return new JsonResponse($dto->toArray(), 200);
    //     }

    //     $dto = new JsonResponseDTO('200', 'ok', ['isRegistered' => $user->isVerified()]);
    //     return new JsonResponse($dto->toArray(), 200);
    // }

    // #[Route('/user_info', methods: ['GET'], name: 'api_login_user_info')]
    // public function getUserFromJwt(UserInterface $user): Response
    // {
    //     $response = $this->userHelper->getUserInfo($user);
    //     return new JsonResponse($response, 200);
    // }
}
