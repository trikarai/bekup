<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonProcessStatusAbstract {
    protected $statusLists = array(
        'active',
        'cancelled',
        'completed',
    );
    /** @var string */
    protected $status;
    
    /**
     * @param string $status
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($status) {
        if(!in_array($status, $this->statusLists)){
            $this->_throwInvalidArgumentExceptionStatement($status, array('pre-define string: active, cancelled, completed'));
        }
        $this->status = $status;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($status, array $allowed_types);
    
    public static function fromNative($status){
        return new static($status);
    }
    
    /** @return string */
    public function value(){
        return $this->status;
    }

    /** @return string */
    public function __toString() {
        return $this->value();
    }
    
    /**
     * @param \Resources\ValueObject\CommonProcessStatusAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonProcessStatusAbstract $other) {
        return ($this->value() === $other->value());
    }
}
