<?php

namespace Programme\Description\Infrastructure\DomainModelRepository\Programme;

use Programme\Description\DomainModel\Programme\IProgrammeRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineProgrammeRepository extends EntityRepository implements IProgrammeRepository{
    public function All() {
        $criteria = array(
            'isRemoved' => false
        );
        return $this->findBy($criteria);
    }

    public function add(\Programme\Description\DomainModel\Programme\Programme $programme) {
        $em = $this->getEntityManager();
        $em->persist($programme);
        $em->flush();
        $em->clear();
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofId($id) {
        $criteria = array(
            'id' => $id,
            'isRemoved' => false
        );
        return $this->findOneBy($criteria);
    }

    public function ofName($name) {
        $criteria = array(
            'name' => $name,
            'isRemoved' => false
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }
}
