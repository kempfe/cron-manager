<?php


namespace CronManager\Command;


use Cron\CronExpression;
use CronManager\Entity\Cron;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

class TestCommand extends ContainerAwareCommand{

    public function configure()
    {
        $this->setName("cm:test")
            ->setDescription("Cron for Testing")
            ->addArgument("testargument",InputArgument::OPTIONAL,"Testargument")
            ->addOption("testoption","to",InputOption::VALUE_OPTIONAL,"Test Option","test")
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
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Log 1. line");
        $output->writeln(get_class_methods($input));
        $output->writeln(var_export($input->getOptions(),true));
        $output->writeln(var_export($input->getArguments(),true));
        $output->writeln("Log 2. line");

    }



}