<?php

namespace Apperclass\TestDocBundle\Repository;

use Apperclass\TestDocBundle\Entity\Test;
use Doctrine\ORM\EntityRepository;

/**
 * Class TestRepository
 *
 * @package Apperclass\TestDocBundle\Repository
 */
class TestRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getAll()
    {
        $queryBuilder = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('t')
            ->from(Test::SHORTCUT_CLASS_NAME, 't')
            ->orderBy('t.url', 'ASC');


        return $queryBuilder->getQuery()->getResult();
    }
}