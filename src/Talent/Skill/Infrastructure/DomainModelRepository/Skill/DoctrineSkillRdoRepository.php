<?php

namespace Talent\Skill\Infrastructure\DomainModelRepository\Skill;

use Doctrine\ORM\EntityRepository;
use Talent\Skill\DomainModel\Skill\DataObject\ISkillRdoRepository;

class DoctrineSkillRdoRepository extends EntityRepository implements ISkillRdoRepository{
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
