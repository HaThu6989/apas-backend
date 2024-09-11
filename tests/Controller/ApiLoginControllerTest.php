<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class ApiLoginControllerTest extends WebTestCase
{
  private $client;
  private $entityManager;

  protected function setUp(): void
  {
    $this->client = static::createClient();
    $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);
  }

  public function testLoginSuccess()
  {
    $user = new User();
    $user->setEmail('admin@aaa.fr');
    $user->setPassword(password_hash('$ApasBTPFormulaire2024!', PASSWORD_BCRYPT));
    $this->entityManager->persist($user);
    $this->entityManager->flush();

    $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
      'username' => 'admin@aaa.fr',
      'password' => '$ApasBTPFormulaire2024!',
    ]));

    $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    $this->assertJson($this->client->getResponse()->getContent());

    // Clean up database
    $this->entityManager->remove($user);
    $this->entityManager->flush();
  }

  public function testLoginFailure()
  {
    $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
      'username' => 'abc123@aaa.fr',
      'password' => 'wrongpassword',
    ]));

    $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    $this->assertJson($this->client->getResponse()->getContent());
  }
}
