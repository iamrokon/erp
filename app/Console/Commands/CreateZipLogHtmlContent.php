<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use Illuminate\Support\Facades\Mail;
use Auth;
use DB;
use Carbon\Carbon;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Mail;
use ZipArchive;
use File;

class CreateZipLogHtmlContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CreateZip:LogHtmlContent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'it will Create from public/log/html_log ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $zip_name = date("Ymd");
        $zip_name = strtotime("-1 days", strtotime($zip_name));
        $zip_name = strftime ( '%Y%m%d' , $zip_name );
        $zip = new ZipArchive;
        if(!file_exists('public/log/html_log')){
            mkdir('public/log/html_log',0777,true);
        }
        
        //add files & folder in zip
        $destination = 'public/log/html_log/'.$zip_name.'.zip';
        $source = 'public/log/html_log/'.$zip_name;
        if (file_exists($source)) {
            $zip = new ZipArchive();
            if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                $source = realpath($source);
                if (is_dir($source)) {
                    $iterator = new \RecursiveDirectoryIterator($source);
                    // skip dot files while iterating
                    $iterator->setFlags(\RecursiveDirectoryIterator::SKIP_DOTS);
                    $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
                    foreach ($files as $file) {
                        $file = realpath($file);
                        if (is_dir($file)) {
                            $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                        } else {
                            if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    }
                } else {
                    if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
            }
            //echo $destination . ' zip: successfully...';
            //echo "\n";
             $zip->close();
        }

        //delete processed folder
//        foreach ($files as $file) {
//            $file = baseName($file);
//            $path    = $source.'/'.$file;
//            $files = scandir($path);
//            $files = array_diff(scandir($path), array('.', '..'));
//            foreach($files as $key=>$val){
//                unlink($path."/".$val);
//            }
//            rmdir($path);
//            rmdir($source);
//        }
        
        //delete processed folder
        $path = $source;
        $files = glob($path . '/*');
	foreach ($files as $file) {
            if(is_dir($file)){
                $newPath = $path."/".baseName($file);
                $files2 = glob($newPath . '/*');
                foreach ($files2 as $file2) {
                    unlink($file2); 
                }
                rmdir($newPath);
            }else{
               unlink($file); 
            }
	}
        rmdir($path);
        
        //delete zip => 1 week before
        $current_date = date("Ymd");
        $mod_date = strtotime("-7 days", strtotime($current_date));
        $mod_date =(int) strftime ( '%Y%m%d' , $mod_date );
        $directory = "public/log/html_log/";
        $files = glob($directory . "*.zip");
        foreach($files as $file)
        {
            $filename = baseName($file);
            $filename_without_ext =(int) preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
            if($filename <= $mod_date){
                unlink($directory."/".$filename);
            }
        }
        
        //$this->info("ddddddddddd");
        return 'succefully created zip log html content';   
    }
}
