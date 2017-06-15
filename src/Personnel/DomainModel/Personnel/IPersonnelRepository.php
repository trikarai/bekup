<?php

namespace Personnel\DomainModel\Personnel;

interface IPersonnelRepository {
    /**
     * @return string
     */
    function nextIdentity();
    
    /**
     * @param \Personnel\DomainModel\Personnel\Personnel $personnel
     */
    function add(Personnel $personnel);
    
    function update();

    /**
     * @param string $id
     * @return Personnel
     */
    function ofId($id);
    
    /**
     * @param string $email
     * @return Personnel
     */
    function ofEmail($email);
    
    /**
     * @return Personnel
     */
    function all();
}
