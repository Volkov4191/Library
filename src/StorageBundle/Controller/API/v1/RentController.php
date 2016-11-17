<?php

namespace StorageBundle\Controller\API\v1;

use FOS\RestBundle\Controller\Annotations as Rest;
use StorageBundle\Entity\Rent;
use StorageBundle\Repository\Rent as RentRepository;

/**
 * Управление заказами кинг
 *
 * Class OrderController
 *
 * @Rest\RouteResource("Rent")
 * @Rest\Version("v1")
 * @Rest\NamePrefix("v1_")
 *
 * @package StorageBundle\Controller\API\v1
 */
class RentController extends \FOS\RestBundle\Controller\FOSRestController
{
    /**
     * Получить список аренд книг
     *
     * TODO: Добавить пагинацию
     *
     * @Rest\View(serializerGroups={"Default"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cgetAction(){
        $rentRepository =  $this->getRepository();
        /** @var Rent[] $links */
        $rents = $rentRepository->findAll();

        return $this->getView($rents);
    }

    /**
     * Детальный просмотр заказа
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($id){
        $rentRepository = $this->getRepository();
        /** @var Rent[] $links */
        $rent = $rentRepository->find($id);

        if (!$rent){
            throw $this->createNotFoundException();
        }

        return $this->getView($rent);
    }

    /**
     * Получить отображение
     *
     * @param $rents
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function getView($rents){
        $view = $this->view($rents, 200)
            ->setTemplateVar('rents')
            ->setTemplate('StorageBundle:Rent:cget.html.twig')
        ;
        return $this->handleView($view);
    }

    /**
     * Получить репозиторий
     *
     * @return RentRepository
     */
    private function getRepository($name = 'StorageBundle:Rent'){
        return $this->getDoctrine()->getManager()->getRepository($name);
    }
}