<?php
namespace StorageBundle\Controller\API\v1;

use FOS\RestBundle\Controller\Annotations as Rest;
use StorageBundle\Entity\Library;
use StorageBundle\Repository\Library as LibraryRepository;
use StorageBundle\Repository\Rent;

/**
 * Управление библиотеками
 *
 * Class LibraryController
 *
 * @Rest\RouteResource("Library")
 * @Rest\Version("v1")
 * @Rest\NamePrefix("v1_")
 *
 * @package StorageBundle\Controller\API\v1
 */
class LibraryController extends \FOS\RestBundle\Controller\FOSRestController
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
        $libraryRepository = $this->getRepository();
        /** @var Library[] $libraries */
        $libraries = $libraryRepository->findAll();

        return $this->getView($libraries);
    }

    /**
     * Получить информацию о библиотеке
     *
     * @param $libraryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($libraryId){
        $libraryRepository = $this->getRepository();
        $library = $libraryRepository->find($libraryId);

        if (!$library){
            throw $this->createNotFoundException();
        }

        return $this->getView($library);
    }

    /**
     * Получить все аренды книг в библиотеке
     *
     * TODO: Пагинация
     *
     * @param $libraryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRentsAction($libraryId){
        $libraryRepository = $this->getRepository();

        /** @var Library $library */
        $library = $libraryRepository->find($libraryId);
        if (!$library){
            throw $this->createNotFoundException();
        }

        /** @var Rent $rentRepository */
        $rentRepository = $this->getRepository('StorageBundle:Rent');
        $rents = $rentRepository->findAllByLibrary($library);

        $view = $this->view($rents, 200)
            ->setTemplateVar('rents')
            ->setTemplate('StorageBundle:Library:rents.html.twig')
        ;
        return $this->handleView($view);
    }

    /**
     * Получить отображение
     *
     * @param $libraries
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function getView($libraries){
        $view = $this->view($libraries, 200)
            ->setTemplateVar('libraries')
            ->setTemplate('StorageBundle:Library:cget.html.twig')
        ;
        return $this->handleView($view);
    }

    /**
     * Получить репозиторий
     *
     * @return LibraryRepository
     */
    private function getRepository($name = 'StorageBundle:Library'){
        return $this->getDoctrine()->getManager()->getRepository($name);
    }
}