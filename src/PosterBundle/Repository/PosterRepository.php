<?php
/**
 * Created by:
 * User: usman
 * Date: 7/11/16
 * Time: 7:27 AM
 */

namespace PosterBundle\Repository;


use Doctrine\ORM\EntityRepository;
use PosterBundle\Entity\Poster;

class PosterRepository extends EntityRepository
{
    public function findAllPublishedOrderedByCreated()
    {
        // @todo order by created newest first
        /**
         * @return Poster[]
         */
        return $this->createQueryBuilder('poster')
            ->andWhere('poster.is_published = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('poster.positionsCount', 'DESC')
            ->getQuery()
            ->execute();
    }
}