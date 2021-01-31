<?php


namespace App\Manager;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Exception;

/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager
{
    /** @var UserRepository  */
    private $userRepository;

    /** @var EntityManager */
    private $em;

    /**
     * UserManager constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, EntityManager $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    /**
     * @return User[]|array
     */
    public function getAllUsers()
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param string $name
     * @param string $surname
     * @throws ORMException
     * @throws Exception
     */
    public function addNewUser(string $name, string $surname)
    {
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setSurname($surname);

        try {
            $this->em->persist($newUser);
            $this->em->flush($newUser);
        } catch (ORMException $e) {
            //JTD
            throw $e;
        }
    }

}