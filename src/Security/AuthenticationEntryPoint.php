<?php

namespace App\Security;

use App\DTO\JsonResponseDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        $responseObj = new JsonResponseDTO(
            (string) Response::HTTP_UNAUTHORIZED, // ugly cast :O
            'Unauthorized',
            []
        );
        return new Response(json_encode($responseObj->toArray()), Response::HTTP_UNAUTHORIZED);
    }
}
