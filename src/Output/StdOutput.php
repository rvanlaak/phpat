<?php

namespace PhpAT\Output;

use PhpAT\App\Configuration;

class StdOutput implements OutputInterface
{
    /**
     * @var resource
     */
    private $okStream = \STDOUT;
    /**
     * @var resource
     */
    private $errStream = \STDERR;

    /**
     * @var int
     */
    private $verbose;

    public function __construct()
    {
        $this->verbose = Configuration::getVerbosity();
        $this->errStream = Configuration::getDryRun() ? \STDOUT : \STDERR;
    }

    public function write(string $message, int $level = OutputLevel::DEFAULT): void
    {
        $this->out($message, $level);
    }

    public function writeLn(string $message, int $level = OutputLevel::DEFAULT): void
    {
        $message .= PHP_EOL;
        $this->out($message, $level);
    }

    private function out(string $message, int $level): void
    {
        if (!in_array($level, VerboseLevel::OUTPUT_LEVEL[$this->verbose])) {
            return;
        }
        $stream = $level > OutputLevel::WARNING ? $this->errStream : $this->okStream;
        fwrite($stream, $message);
    }
}
