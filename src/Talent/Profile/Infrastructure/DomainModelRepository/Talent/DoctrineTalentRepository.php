<?php

namespace Talent\Profile\Infrastructure\DomainModelRepository\Talent;

use Talent\Profile\DomainModel\Talent\ITalentRepository;
use Talent\Profile\DomainModel\Talent\Talent;
use Doctrine\ORM\EntityRepository;

class DoctrineTalentRepository extends EntityRepository implements ITalentRepository{
    public function add(Talent $talent) {
        $em = $this->getEntityManager();
        $em->persist($talent);
        $em->flush();
    }


    public function nextIdentity() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }

    public function ofEmail($email) {
        $criteria = array(
            'email' => $email,
        );
        return $this->findOneBy($criteria);
    }

    public function ofId($id) {
        $criteria = array(
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }

    public function ofUserName($userName) {
        $criteria = array(
            'userName' => $userName,
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }
}
