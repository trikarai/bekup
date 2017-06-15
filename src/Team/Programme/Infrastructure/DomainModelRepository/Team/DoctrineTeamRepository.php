<?php

namespace Team\Programme\Infrastructure\DomainModelRepository\Team;

use Doctrine\ORM\EntityRepository;
use Team\Programme\DomainModel\Team\ITeamRepository;

class DoctrineTeamRepository extends EntityRepository implements ITeamRepository{
    public function ofId($id) {
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
