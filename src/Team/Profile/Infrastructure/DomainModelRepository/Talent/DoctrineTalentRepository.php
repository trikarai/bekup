<?php

namespace Team\Profile\Infrastructure\DomainModelRepository\Talent;

use Doctrine\ORM\EntityRepository;
use Team\Profile\DomainModel\Team\Team;
use Superclass\DomainModel\Team\TeamReadDataObject;
use Team\Profile\DomainModel\Talent\ITalentRepository;

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

    public function availableTalentToInvite(TeamReadDataObject $teamRdo, $offset, $limit) {
        $qb1 = $this->getEntityManager()->createQueryBuilder();
        $qb2 = $this->getEntityManager()->createQueryBuilder();
        
        $qb1->select('tln')
            ->from('\Team\Profile\DomainModel\Talent\Talent', 'tln')
            ->leftJoin('tln.cityRDO', 'ctyrdo')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('tln.name', 'ASC')
            ->where($qb1->expr()->andX(
                $qb1->expr()->eq('ctyrdo.id', "'{$teamRdo->cityRDO()->getId()}'"),
                $qb2->expr()->notIn('tln.id', 
                    $qb2->select('tln2.id')
                        ->from('\Team\Profile\DomainModel\Membership\Membership', 'mmb')
                        ->leftJoin('mmb.talent', 'tln2')
                        ->leftJoin('mmb.team', 'team')
                        ->where($qb2->expr()->andX(
                            $qb2->expr()->eq('team.id', "'{$teamRdo->getId()}'"),
                            $qb2->expr()->orX(
                                $qb2->expr()->eq('mmb.status', "'active'"),
                                $qb2->expr()->eq('mmb.status', "'invited'")
                            )
                        ))
                        ->getDQL()
                )
            ));
        return $qb1->getQuery()->getResult();
    }
}