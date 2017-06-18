<?php

namespace Talent\Entrepreneurship\Infrastructure\DomainModelRepository\Talent;

use Talent\Entrepreneurship\DomainModel\Talent\ITalentRepository;
use Doctrine\ORM\EntityRepository;

class  DoctrineTalentRepository extends EntityRepository implements ITalentRepository{
    public function OfId($id) {
        $criteria = array(
            'id' => $id,
        );
        return $this->findOneBy($criteria);
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }

}
