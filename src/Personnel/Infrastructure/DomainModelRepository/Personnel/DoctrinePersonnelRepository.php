<?php

namespace Personnel\Infrastructure\DomainModelRepository\Personnel;

use Personnel\DomainModel\Personnel\IPersonnelRepository;
use Personnel\DomainModel\Personnel\Personnel;

use Doctrine\ORM\EntityRepository;

class DoctrinePersonnelRepository extends EntityRepository implements IPersonnelRepository{
    public function add(Personnel $personnel) {
        $em = $this->getEntityManager();
        $em->merge($personnel);
        $em->flush();
    }

    public function all() {
        return $this->findBy(['isRemoved' => false]);
    }

    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofEmail($email) {
        $criteria = array(
            'isRemoved' => false,
            'email' => $email
        );
        return $this->findOneBy($criteria);
    }

    public function ofId($id) {
        $criteria = array(
            'isRemoved' => false,
            'id' => $id
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }
}
