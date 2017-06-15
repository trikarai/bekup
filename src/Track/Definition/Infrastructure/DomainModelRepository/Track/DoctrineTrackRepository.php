<?php

namespace Track\Definition\Infrastructure\DomainModelRepository\Track;

use Track\Definition\DomainModel\Track\ITrackRepository;
use Track\Definition\DomainModel\Track\Track;

use Doctrine\ORM\EntityRepository;

class DoctrineTrackRepository extends EntityRepository implements ITrackRepository{
    public function add(Track $track) {
        $em = $this->getEntityManager();
        $em->persist($track);
        $em->flush();
        $em->clear();
    }

    public function all() {
        $criteria = array(
            'isRemoved' => false
        );
        return $this->findBy($criteria);
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        $criteria = array(
            'isRemoved' => false,
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }

    public function ofName($name) {
        $criteria = array(
            'isRemoved' => false,
            'name' => $name,
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }

}
