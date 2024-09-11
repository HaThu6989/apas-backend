<?php

namespace App\Serializer;

use App\DTO\JsonResponseDTO;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RestApiProblemNormalizer implements NormalizerInterface
{
    public function normalize(mixed $exception, ?string $format = null, array $context = [])
    {
        $errorMsg = $exception->getMessage();
        if (!is_null(json_decode($errorMsg))) {
            $errorMsg = json_decode($errorMsg, true);
        }
        if (!is_array($errorMsg)) {
            $errorMsg = [$errorMsg];
        }
        $responseObj = new JsonResponseDTO(
            $exception->getStatusCode(),
            'An error has occurred',
            $errorMsg
        );
        return $responseObj->toArray();
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof FlattenException;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [/* List of supported types */];
    }
}
