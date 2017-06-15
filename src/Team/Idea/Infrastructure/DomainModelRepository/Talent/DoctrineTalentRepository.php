<?php

namespace Team\Idea\Infrastructure\DomainModelRepository\Talent;

use Team\Idea\DomainModel\Talent\ITalentRepository;
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
