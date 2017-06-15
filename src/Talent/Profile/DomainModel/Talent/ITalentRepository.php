<?php

namespace Talent\Profile\DomainModel\Talent;

interface ITalentRepository {
    function nextIdentity();
    
    function add(Talent $talent);
    
    function update();
    
    /**
     * @param string $id
     * @return Talent
     */
    function ofId($id);
    
    /**
     * @param string $userName
     * @return Talent
     */
    function ofUserName($userName);
    
    /**
     * @param string $email
     * @return Talent
     */
    function ofEmail($email);
    
}
