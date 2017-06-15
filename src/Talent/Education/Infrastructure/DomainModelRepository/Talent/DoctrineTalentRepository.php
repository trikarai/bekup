<?php

namespace Talent\Education\Infrastructure\DomainModelRepository\Talent;

use Talent\Education\DomainModel\Talent\ITalentRepository;
use Talent\Education\DomainModel\Talent\Talent;

use Doctrine\ORM\EntityRepository;

class DoctrineTalentRepository extends EntityRepository implements ITalentRepository{
    public function ofId($id) {
        $criteria = array(
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
