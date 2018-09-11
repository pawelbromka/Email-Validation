<?php

namespace App\Service;

use App\Service\FileManager;

class ValidateReport
{
    private $correctEmails = [];
    private $incorrectEmails = [];
    private $inputFilename;
    
    public function add($email, $status)
    {
        switch ($status) {
            
            case true:
                $this->correctEmails[] = $email;
                break;
                
            case false:
                $this->incorrectEmails[] = $email;
                break;    
        }
    }
    
    public function getCorrectEmails()
    {
        return $this->correctEmails;
    }    
    
    public function getIncorrectEmails()
    {
        return $this->incorrectEmails;
    }      

    public function countCorrectEmails()
    {
        return count($this->correctEmails);
    }    
    
    public function countIncorrectEmails()
    {
        return count($this->incorrectEmails);
    }          

    public function countAllEmails()
    {
        return count($this->correctEmails) + count($this->incorrectEmails);
    }       
    
    public function setInputFilename($filename)
    {
        $this->inputFilename = $filename;
    }
    
    public function getInputFilename()
    {
        return $this->inputFilename;
    }    

    public function getReportDate()
    {
        return date('Y-m-d H:i:s');
    }              
    
    public function getSummary()
    {
        $summary = 'Report date: ' . $this->getReportDate() . "\n";
        $summary .= 'Input filename: ' . $this->getInputFilename() . "\n";
        $summary .= 'Amount of correct emails: ' . $this->countCorrectEmails() . "\n";
        $summary .= 'Amount of incorrect emails: ' . $this->countIncorrectEmails() . "\n";
        $summary .= 'Amount of all emails: ' . $this->countAllEmails();
        
        return $summary;
    }      
    
    public function export()
    {
        $fileManager = new FileManager();
        $fileManager->save_results(FileManager::REPORT_CORRECT, $this->getCorrectEmails());
        $fileManager->save_results(FileManager::REPORT_INCORRECT, $this->getIncorrectEmails());
        $fileManager->save_summary(FileManager::REPORT_SUMMARY, $this->getSummary());
    }                  
}