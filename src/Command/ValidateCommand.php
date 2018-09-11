<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\EmailValidator;
use App\Service\ValidateReport;
use App\Service\FileManager;

class ValidateCommand extends Command
{
    
    protected function configure()
    {
        $this
            ->setName('app:validate')
            ->setDescription('E-mail validate')
            ->setHelp('This command allows you to validate e-mail addresses');
        
      $this
          ->addArgument('filename', InputArgument::REQUIRED, 'Name of input file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');
        $file = FileManager::DATA_PATH . $filename;
        
        if (file_exists($file)) {
            
            $validator = new EmailValidator();
            $report = new ValidateReport();    
            $emails = file($file);
            
            foreach ($emails as $email) {
                $email = trim($email);
                $report->add($email, $validator->check($email));
            }
            
            $report->setInputFilename($filename);
            $report->export();
            
            $output->writeln('Process validation from file: ' . $filename . ' completed.');
            
        } else {
            $output->writeln('File not exists: ' . $filename);
        }
    }
}