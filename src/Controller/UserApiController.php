<?php

namespace App\Controller;

use App\Manager\UserManager;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserApiController
 * @package App\Controller
 * @Rest\Route("/api", name="api")
 */
class UserApiController extends AbstractFOSRestController
{
    /** @var UserManager */
    private $userManager;

    /**
     * UserApiController constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @Rest\Get("/users")
     *
     * @return JsonResponse
     */
    public function getAllUsers()
    {
        return new JsonResponse($this->userManager->getAllUsers());
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @return JsonResponse
     * @Rest\Post("/user")
     *
     * @Rest\RequestParam(name="name", requirements="[0-9a-zA-ZąćęłóńźżĄĆĘŁÓŃŹŻ0-9 -]+", description="Name of requested user")
     * @Rest\RequestParam(name="surname", requirements="[0-9a-zA-ZąćęłóńźżĄĆĘŁÓŃŹŻ0-9 -]+", description="Surname of requested user")
     *
     * @throws ORMException
     */
    public function addNewUser(ParamFetcher $paramFetcher)
    {
        $name = $paramFetcher->get('name');
        $surname = $paramFetcher->get('surname');

        $this->userManager->addNewUser($name, $surname);

        return new JsonResponse("Poprawnie dodano użytkownika: $name $surname");
    }
}
