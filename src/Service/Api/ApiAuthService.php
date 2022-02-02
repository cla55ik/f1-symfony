<?php

namespace App\Service\Api;

use App\Entity\ApiKey;
use Doctrine\ORM\EntityManagerInterface;

class ApiAuthService
{
    private string $owner = '';
    private EntityManagerInterface $entityManager;
    private ApiKey $apiKey;

    public function __construct(EntityManagerInterface $entityManager, ApiKey $apiKey)
    {
        $this->entityManager = $entityManager;
        $this->apiKey = $apiKey;
    }

    public function createNewApiKey(string $owner): ?string
    {
        $this->owner = $owner;
        if (!$this->isValidOwner()){
            return null;
        }

        $apiKey = new ApiKey();
        $apiKey->setOwner($owner);
        $apiKey->setKey($this->generateApiKey());
        $apiKey->setIsActive(true);

        $this->entityManager->persist($apiKey);
        $this->entityManager->flush();
    }

    private function isValidOwner():bool
    {
        $findOwner = $this->entityManager->getRepository(ApiKey::class)->findBy(['owner' => $this->owner]);
        if (!$findOwner){
            return true;
        }

        return false;
    }

    private function generateApiKey(): string
    {
        $key = substr(str_shuffle(ApiKey::PERMITTED_CHARS), 0, 10);
        $key .= '-';
        $key .= substr(str_shuffle(ApiKey::PERMITTED_CHARS), 0, 10);
        $key .= '-';
        $key .= substr(str_shuffle(ApiKey::PERMITTED_CHARS), 0, 10);

        return $key;
    }

}