<?php


namespace CronManager\Command;


use Cron\CronExpression;
use CronManager\Entity\Cron;
use CronManager\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

class CronCommand extends ContainerAwareCommand{

    public function configure()
    {
        $this->setName("cm:run")
            ->setDescription("Starts the Cron Manager Routine")
            ->addOption("interval","i",InputOption::VALUE_OPTIONAL,"Execution interval in seconds",300)
            ->addOption("processCheck","pc",InputOption::VALUE_OPTIONAL,"Checks if the cron process is stil running ( only working under linux )",1)
            ;
    }


    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * Doctrine Entity Manger
     * @return EntityManagerInterface
     */
    public function getEntityManager(){
        if(!$this->em) {
            $this->em =  $this->getContainer()->get("doctrine.orm.entity_manager");
        }
        return $this->em;
    }


    /**
     *  Cron Execution Service
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $interval = (int) $input->getOption("interval");

        /* @var $crons Cron[] */
        $crons = $this->getEntityManager()->getRepository("CronManager\Entity\Cron")->findBy([
            'active' => 1
        ]);


        foreach($crons as $cron){
            // Check if Cron is stil running
            if($input->getOption("processCheck")){
                if($cron->getProcessId() && file_exists(sprintf("/proc/%s",$cron->getProcessId()))){
                    $output->writeln(sprintf("CRON : %s - Skipping, stil running",$cron->getId()));
                    continue;
                }
            }

            $expression = CronExpression::factory($cron->getExpression());
            $expression->isDue();

            $intervalDate = new \DateTime();
            $intervalDate->modify(sprintf("-%s seconds",$input->getOption("interval")));

            if($expression->getNextRunDate($intervalDate) <= new \DateTime()) {
                $output->write(sprintf("CRON : %s - Executing...",$cron->getId()));
                $cron->setProcessId(getmypid());
                $cron->setLastExecution(new \DateTime());
                $cron->setNextExecution($expression->getNextRunDate());
                $this->getEntityManager()->persist($cron);
                $this->getEntityManager()->flush();
                try {
                    $command = $this->getApplication()->find($cron->getCommand());
                    $arguments = array_merge(['command' => $cron->getCommand()],$cron->getArguments());
                    $response = new BufferedOutput();

                    $hasError = false;
                    try {
                        $returnCode = $command->run(new ArrayInput($arguments), $response);
                        $log = rtrim($response->fetch());

                    }catch(\Exception $e){
                        $log = $e->getMessage();
                        $hasError = true;
                    }

                    // Create Logfile
                    $logEntry = new Log();
                    $logEntry->setCron($cron);
                    $logEntry->setLog($log);
                    $logEntry->setHasError($hasError);
                    $this->getEntityManager()->persist($logEntry);
                    $this->getEntityManager()->flush();
                    $output->writeln(sprintf("done", $cron->getId()));
                }catch(CommandNotFoundException $e){
                    $output->writeln(sprintf("Command \"%s\" not found",$cron->getCommand()));
                }

            }

        }
    }

    /**
     * Executes a Cron Command
     * @param Cron $cron
     */
    public function executeCron(Cron $cron){


    }


}