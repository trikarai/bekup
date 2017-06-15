<?php

namespace City\Profile\Infrastructure\DomainModelRepository\City;

use City\Profile\DomainModel\City\ICityRepository;
use City\Profile\DomainModel\City\City;

use Doctrine\ORM\EntityRepository;

class DoctrineCityRepository extends EntityRepository implements ICityRepository{
    public function add(City $city) {
        $em = $this->getEntityManager();
        $em->persist($city);
        $em->flush();
    }

    public function all() {
        $criteria = array(
            'isRemoved' => false,
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
