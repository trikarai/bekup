<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonPasswordAbstract {
    protected $plainPassword = null;
    protected $hashedPassword = null;
    
    /**
     * @param string $plainPassword
     * @return \static
     * @throws InvalidNativeArgumentException
     */
    public static function fromNative($plainPassword){
        /**
        Minimum 8 characters at least 1 Alphabet and 1 Number:
        $regex = "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$";
        Minimum 8 characters at least 1 Alphabet, 1 Number and 1 Special Character:
        $regex = "^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$";
        Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet and 1 Number:
        $regex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$";
        Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:
        $regex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}";
        Minimum 8 and Maximum 10 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:
        $regex = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}";
         * 
         */
//        $regex = "/^[A-Za-z\d$@$!%*#?&]+$/";
//        $filteredPassword = filter_var($plainPassword, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $regex)));
//        if(empty($filteredPassword)){
//            throw new InvalidNativeArgumentException($plainPassword, array('string Password'));
//        }
//        return new static(null, $filteredPassword);
        
//DILO PASSWORD
        return new static(null, $plainPassword);
    }
    
    /**
     * @param string $hashedPassword
     * @return \static
     * @throws InvalidNativeArgumentException
     */
    public static function fromHashed($hashedPassword){
        $regex = "/^(\\$2a\\$).{56}$/";
        $filteredHashPassword = filter_var($hashedPassword, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>$regex)));
        if(empty($filteredHashPassword)){
            $this->_throwInvalidArgumentExceptionStatement($hashedPassword, 'hashed password', $allowed_types);
        }
        return new static($filteredHashPassword, null);
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($hashedPassword, $fieldName, array $allowed_types);
    
    /** @param string $plainPassword */
    protected function _setPlainPassword($plainPassword){
        $this->plainPassword = $plainPassword;
        $this->hashedPassword = $this->_hashingPassword($plainPassword);
    }

    /**
     * @param string $hashedPassword
     * @param string $plainPassword
     */
    protected function __construct($hashedPassword = null, $plainPassword = null) {
        if(null === $hashedPassword){
            $this->_setPlainPassword($plainPassword);
        } else{
            $this->hashedPassword = $hashedPassword;
        }
    }
    
    /** @return string */
    public function plainValue(){
        return $this->plainPassword;
    }
    
    /** @return string */
    public function hashedValue(){
        return $this->hashedPassword;
    }
    
    /** @return string */
    public function __toString() {
        return $this->hashedValue();
    }
    
    /**
     * @param CommonPasswordAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonPasswordAbstract $other) {
        if(null === $this->plainValue()){
            return (true === $this->_hash_equals($this->hashedValue(), crypt($other->plainValue(), $this->hashedValue())) ||
                    $this->hashedValue() === $other->hashedValue());
        }
        return( $this->plainValue() === $other->plainValue() ||
                $this->_hash_equals($other->hashedValue(), crypt($this->plainValue(), $other->hashedValue())));
    }
    
    /**
     * @param string $plainPassword
     * @param int $cost
     * @return string
     */
    protected function _hashingPassword($plainPassword, $cost = 10){
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = sprintf("$2a$%02d$", $cost) . $salt;
        return crypt($plainPassword, $salt);
    }
    
    /**
     * @param string $str1
     * @param string $str2
     * @return boolean
     */
    protected function _hash_equals($str1, $str2) {
        if(function_exists("hash_equals")){
            return hash_equals($str1, $str2);
        }
        if(strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
            return !$ret;
        }
    }
}