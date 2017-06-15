<?php

namespace Superclass\Infrastructure\DomainModelRepository\Track;

use Superclass\DomainModel\Track\ITrackRdoRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineTrackRdoRepository extends EntityRepository implements ITrackRdoRepository{
    public function all() {
        $criteria = array(
            'isRemoved' => false,
        );
        return $this->findBy($criteria);
    }

    public function ofId($id) {
        $criteria = array(
            'id' => $id,
            'isRemoved' => false,
        );
        return $this->findOneBy($criteria);
    }
}
