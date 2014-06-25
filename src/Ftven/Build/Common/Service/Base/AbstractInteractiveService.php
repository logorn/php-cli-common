<?php

namespace Ftven\Build\Common\Service\Base;

use Ftven\Build\Common\ServiceInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractService implements ServiceInterface
{
    /**
     * @var OutputInterface
     */
    protected $output;
    /**
     * @var InputInterface
     */
    protected $input;
    /**
     * @param InputInterface $input
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setInput($input)
    {
        if (null === $this->input) {
            throw new \RuntimeException('Input stream not set', 500);
        }

        $this->input = $input;

        return $this;
    }
    /**
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }
    /**
     * @param OutputInterface $output
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setOutput($output)
    {
        if (null === $this->output) {
            throw new \RuntimeException('Output stream not set', 500);
        }

        $this->output = $output;

        return $this;
    }
    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }
}