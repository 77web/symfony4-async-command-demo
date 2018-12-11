<?php


namespace App\Command;


use Enqueue\AsyncCommand\Commands;
use Enqueue\AsyncCommand\RunCommand;
use Enqueue\Client\ProducerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnqueueCommand extends Command
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;

        parent::__construct('demo:enqueue');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->producer->sendCommand(Commands::RUN_COMMAND, new RunCommand('demo:hello', ['77web'], ['--time=morning']));
    }
}
