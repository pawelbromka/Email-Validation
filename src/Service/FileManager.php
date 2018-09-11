<?php

namespace App\Service;

class FileManager
{
    const REPORT_CORRECT   = 'report_correct.txt';
    const REPORT_INCORRECT = 'report_incorrect.txt';
    const REPORT_SUMMARY   = 'report_summary.txt';
    const DATA_PATH        = 'public/data/';
    
    public function save_results($filename, $results) {
        
        $content = implode("\n", $results);
        file_put_contents(self::DATA_PATH . $filename, $content);
    }
    
    public function save_summary($filename, $summary) {
        
        file_put_contents(self::DATA_PATH . $filename, $summary);
    }    
}