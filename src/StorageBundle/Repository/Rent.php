<?php
namespace StorageBundle\Repository;
use StorageBundle\Entity\Library as LibraryModel;
use StorageBundle\Entity\LibraryUser;
use StorageBundle\Entity\User as UserModel;

/**
 * Репозиторий для поиска аренд книг
 *
 * Class Rent
 *
 * TODO: Можно объединить поиск по юзеры и по библиотеке в один метод
 *
 * @package StorageBundle\Repository
 */
class Rent extends \Doctrine\ORM\EntityRepository{
    /**
     * Получить все аренды книг пользователя
     *
     * TODO: Можно сделать через LEFT JOIN одним запросом
     *
     * @param UserModel $user
     * @return array
     */
    public function findAllByUser(UserModel $user){
        $libraryUserIds = [];
        /** @var LibraryUser $libraryUser */
        foreach($user->getLibraryUsers() as $libraryUser){
            $libraryUserIds[] = $libraryUser->getId();
        };

        return $libraryUserIds ? $this->findBy(['libraryUser' => $libraryUserIds]) : [];
    }

    /**
     * Получить все аренды книг библиотеки
     *
     * TODO: Можно сделать через LEFT JOIN одним запросом
     *
     * @param LibraryModel $library
     * @return array
     */
    public function findAllByLibrary(LibraryModel $library)
    {
        $libraryUserIds = [];
        foreach($library->getLibraryUsers() as $libraryUser){
            $libraryUserIds[] = $libraryUser->getId();
        };

        return $libraryUserIds ? $this->findBy(['libraryUser' => $libraryUserIds]) : [];
    }
}