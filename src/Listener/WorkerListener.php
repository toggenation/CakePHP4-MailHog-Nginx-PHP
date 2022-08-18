<?php

namespace App\Listener;

use Cake\Event\EventListenerInterface;
use Cake\Log\LogTrait;
use Psr\Log\LogLevel;

class WorkerListener implements EventListenerInterface
{
    use LogTrait;

    public function implementedEvents(): array
    {
        return [
            'Processor.message.exception' => 'processorMessageException',
            'Processor.message.invalid' => 'processorMessageInvalid',
            'Processor.message.reject' => 'processorMessageReject',
            'Processor.message.success' => 'processorMessageSuccess',
            'Processor.maxIterations' => 'processorMaxIterations',
            'Processor.maxRuntime' => "processorMaxRuntime",
            'Processor.message.failure' => "processorMessageFailure",
            'Processor.message.seen' => 'processorMessageSeen',
            'Processor.message.start' => 'processorMessageStart',
        ];
    }

    public function processorMessageException($message, $exception)
    {
        // $this->log(__METHOD__);
        $this->log($exception);
    }

    public function processorMessageInvalid($message)
    {
        // $this->log(__METHOD__);
    }

    public function processorMessageReject($message)
    {
        // $this->log(__METHOD__);
    }

    public function processorMessageSuccess($message)
    {

        /**
         * @var \Cake\Queue\Job\Message $cakeMessage
         */
        $cakeMessage = $message->getData('message');

        $this->log($cakeMessage->getArgument()['args'][0]);


        /**
         * @var \Enqueue\Redis\RedisMessage $message
         */
        // $message = $message->getData('queueMessage');

        // $this->log(json_decode($message->getBody(), true)['data']['args'][0], LogLevel::INFO);
    }
    public function processorMaxIterations()
    {
        $this->log(__METHOD__);
    }
    public function processorMaxRuntime()
    {
        $this->log(__METHOD__);
    }
    public function processorMessageFailure($message)
    {

        $this->log(__METHOD__);
    }
    public function processorMessageSeen($queueMessage)
    {

        // $this->log(__METHOD__);
    }
    public function processorMessageStart($message)
    {
        // $this->log(__METHOD__);
    }
}
