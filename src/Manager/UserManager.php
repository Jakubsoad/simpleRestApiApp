<?php


namespace App\Manager;


use App\Entity\User;
use App\Repository\UserRepository;
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

    /**
     * UserManager constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]|array
     * @throws Exception
     */
    public function getAllUsers()
    {
        $users = $this->userRepository->getAllUsersArray();

        if ($users === []) {
            throw new Exception('W bazie nie ma żadnego użytkownika!');
        }

        return $users;
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

    /**
     * @param $id
     * @throws Exception
     *
     * @return User
     */
    public function getUserById($id)
    {
        return $this->userRepository->findOneArr($id);
    }

}