<?php

namespace Talent\Skill\Infrastructure\DomainModelRepository\SkillScore;

use Talent\Skill\DomainModel\SkillScore\ISkillScoreRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineSkillScoreRepository extends EntityRepository implements ISkillScoreRepository{
    public function ofId($id, $talentId) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('sks')
                ->from('\Talent\Skill\DomainModel\SkillScore\SkillScore', 'sks')
                ->leftJoin('sks.talent', 'tln')
                ->where($qb->expr()->andX(
                        $qb->expr()->eq('sks.id', "'{$id}'"),
                        $qb->expr()->eq('tln.id', "'{$talentId}'")
                ));
        try{
            return $qb->getQuery()->getSingleResult();
            
        } catch(\Doctrine\ORM\NoResultException $er){
            return null;
        } catch(\Doctrine\ORM\NonUniqueResultException $e){
            return null;
        }
    }

    public function update() {
        $em = $this->getEntityManager();
        $em->flush();
        $em->clear();
    }
}
