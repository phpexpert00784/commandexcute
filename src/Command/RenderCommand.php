<?php
namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

class RenderCommand extends Command
{
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->addArgument('url', [
            'help' => 'What is your url'
        ]);
        return $parser;
    }


    public function execute(Arguments $args, ConsoleIo $io)
    {
        $url = $args->getArgument('url');

        //fetch last 4 characters to check format(.xml)
        $lastNCharacters = substr($url, -4); 

        //check xml file name format check
        if($lastNCharacters == '.xml'){

            //load xml from url and hides the warnings too
            $xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOWARNING);

            //convert object array to associative array
            $json_string = json_encode($xml);    
            $xml =  json_decode($json_string, true);

            //check response from xml file
            if(is_array($xml)) {
                $io->out(print_r($xml));

                //start function
            }else{
                 $io->out('Empty file OR Invalid file name');
            }
            
        }else{
            $io->out('Invalid XML file format');
        }
        
       
    
    }
