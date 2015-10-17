<?php namespace MCS;
 
use Exception;

class HtmlToPdf{
  
    protected $descriptorSpec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ];
    
    protected $wkhtmltopdfPath = null;
    
    protected $cmdPrefix = [];
    
    protected $wkhtmltopdfParams = ['quiet'];
    
    protected $html = null;
    
    protected $command = null;
    
    protected $pdf = null;
    
    /**
     * @param string $html
     */
    public function __construct($html, $path)
    {
        if (empty($html)){
            throw new Exception('Html is empty');     
        }
        if (empty($path)){
            throw new Exception('Wkhtmltopdf path is empty');     
        }
        $this->html = $html;
        $this->wkhtmltopdfPath = $path;
    }
    
    /**
     * Set additional parameters for wkhtmltopdf
     * See http://wkhtmltopdf.org/usage/wkhtmltopdf.txt
     * @param string $name the option name without dashes
     * @param string $value the option value, leave empty if this option doesn't have a value
     */
    public function setParam($name, $value = false)
    {
     $this->wkhtmltopdfParams[] = $name . ( $value ? ' ' . $value : null );
     $this->wkhtmltopdfParams = array_keys(array_flip($this->wkhtmltopdfParams));    
    }
   
    /**
     * Execute the command
     * @return string pdf
     */
    public function generate()
    {
        if (count($this->cmdPrefix)){
            $this->command .= implode(';' , $this->cmdPrefix) . '; ';  
        }
        $this->command .= $this->wkhtmltopdfPath . ' --' . implode(' --', $this->wkhtmltopdfParams) . ' - -';
        $process = proc_open($this->command, $this->descriptorSpec, $pipes);
        fwrite($pipes[0], $this->html);
        fclose($pipes[0]);
        $this->pdf = stream_get_contents($pipes[1]);
        $errors = stream_get_contents($pipes[2]);
        if ($errors){
            $errors = ucfirst(strtr($errors, [
                'sh: wkhtmltopdf: ' => '',
                PHP_EOL => ''
            ]));
            throw new Exception($errors); 
        }
        fclose($pipes[1]);
        $return_value = proc_close($process);
        return $this->pdf; 
    }
    
    /**
     * Add a command before the wkhtmltopdf command
     * @param string $command example 'unset DYLD_LIBRARY_PATH'
     */
    public function addBeforeCommand($command)
    {
        $this->cmdPrefix[] = $command;
    }
    
 
}