<?php

namespace Talent\WorkingExperience\Infrastructure\DomainModelRepository\Talent;

use Talent\WorkingExperience\DomainModel\Talent\ITalentRepository;

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
