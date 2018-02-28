<?php

namespace Babel\Transpiler;

use Babel\Transpiler\Loader as LoaderJs;

class Core {
    
    protected $v8 = null;
    protected $BabelJS = null;
    protected $BabelOptions = ["presets" => ['es2015']];
    
    public function __construct($BabelOptions = [], $BabelJSFile = null){
        $this->v8 = new \V8Js();
        
        if($BabelJSFile === null){
            $BabelJSFile = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'Js' . DIRECTORY_SEPARATOR . "babel.min.js";
        }
        
        $BabelJS = new LoaderJs($BabelJSFile);
        
        if(!$BabelJS->checkFile()){
            throw new \Exception("BabelJS not found");
        }
        
        $this->BabelJS = $BabelJS->load();
        $this->BabelOptions = array_merge($BabelOptions, $this->BabelOptions);
    }
    
    
    public function execute($Code) {
        $this->v8->sourceCode = $Code;
        try {
            return $this->v8->executeString(
                $this->BabelJS . '
                Babel.transform(PHP.sourceCode, ' . json_encode($this->BabelOptions) . ').code;
            ');
        } catch(\V8JsException $e) {
            throw new \Exception($e->getMessage());
        }
        
        return "";
    }
    
}
    