<?php

namespace Programme\Description\DomainModel\Programme;

interface IProgrammeRepository {
    function nextIdentity();
    /**
     * @param \Programme\Description\DomainModel\Programme\Programme $programme
     */
    function add(Programme $programme);
    function update();
    
    /**
     * @param type $id
     * @return Programme
     */
    function ofId($id);
    /**
     * @param type $name
     * @return Programme
     */
    function ofName($name);
}