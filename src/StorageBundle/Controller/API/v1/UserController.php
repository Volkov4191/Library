<?php

namespace StorageBundle\Controller\API\v1;
use FOS\RestBundle\Controller\Annotations as Rest;
use StorageBundle\Entity\User;
use StorageBundle\Repository\Rent as RentRepository;
use StorageBundle\Repository\User as UserRepository;

/**
 * Управление юзерами
 *
 * Class UserController
 *
 * @Rest\RouteResource("User")
 * @Rest\Version("v1")
 * @Rest\NamePrefix("v1_")
 *
 * @package StorageBundle\Controller\API\v1
 */
class UserController extends \FOS\RestBundle\Controller\FOSRestController
{
    /**
     * Получить список пользователей
     *
     * TODO: Добавить пагинацию
     *
     * @Rest\View(serializerGroups={"Default"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgetAction(){
        $userRepository = $this->getDoctrine()->getManager()->getRepository('StorageBundle:User');
        /** @var User[] $users */
        $users = $userRepository->findAll();

        return $this->getView($users);
    }

    /**
     * Детальный просмотр
     *
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($userId){
        $userRepository = $this->getDoctrine()->getManager()->getRepository('StorageBundle:User');
        /** @var User $user */
        $user = $userRepository->find($userId);

        if (!$user){
            throw $this->createNotFoundException();
        }

        return $this->getView($user);
    }

    /**
     * Получить все аренды книг юзера
     *
     * TODO: Пагинация
     *
     * @param $userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRentsAction($userId){
        $userRepository = $this->getRepository();
        /** @var User $user */
        $user = $userRepository->find($userId);

        if (!$user){
            throw $this->createNotFoundException();
        }

        /** @var RentRepository $rentRepository */
        $rentRepository = $this->getRepository('StorageBundle:Rent');
        $rents = $rentRepository->findAllByUser($user);

        $view = $this->view($rents, 200)
            ->setTemplateVar('rents')
            ->setTemplate('StorageBundle:User:rents.html.twig')
        ;
        return $this->handleView($view);
    }

    /**
     * Получить отображение
     *
     * @param $users
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function getView($users){
        $view = $this->view($users, 200)
            ->setTemplateVar('users')
            ->setTemplate('StorageBundle:User:cget.html.twig')
        ;
        return $this->handleView($view);
    }

    /**
     * Получить репозиторий
     *
     * @return UserRepository|RentRepository
     */
    private function getRepository($name = 'StorageBundle:User'){
        return $this->getDoctrine()->getManager()->getRepository($name);
    }
}