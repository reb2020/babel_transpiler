<?php

namespace Babel\Transpiler;

class Loader {
    
    protected $File = null;
    
    public function __construct($File){
        $this->File = $File;
    }
    
    public function checkFile(){
        return file_exists($this->File);
    }
    
    public function load(){
        return file_get_contents($this->File);
    }
    
}