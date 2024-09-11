<?php

/**
 * This class handle exceptions and error
 */

namespace App\Listener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Psr\Log\LoggerInterface;

/**
 * This class handle exceptions and error
 */
class ExceptionListener
{
    private $logger;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger The logger class
     *
     * @return void
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * This function is used when an exception will be triggered
     *
     * @param ExceptionEvent $event The specific event object
     *
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        // You get the exception object from the received event
        $this->logger->error($event->getThrowable()->getCode() . ' - ' . $event->getThrowable()->getMessage());
    }

    /**
     * This function is used when an exception will be triggered from a consol command
     *
     * @param ConsoleErrorEvent $event The specific event object
     *
     * @return void
     */
    public function onConsoleError(ConsoleErrorEvent $event): void
    {
        $this->logger->error($event->getError()->getMessage());
    }
}
