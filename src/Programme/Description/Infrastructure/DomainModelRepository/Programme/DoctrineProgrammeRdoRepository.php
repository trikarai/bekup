<?php

namespace Programme\Description\Infrastructure\DomainModelRepository\Programme;

use Doctrine\ORM\EntityRepository;
use Programme\Description\DomainModel\Programme\IProgrammeRdoRepository;

class DoctrineProgrammeRdoRepository extends EntityRepository implements IProgrammeRdoRepository{
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
