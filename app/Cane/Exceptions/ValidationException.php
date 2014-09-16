<?php namespace Cane\Exceptions;

use Illuminate\Support\MessageBag;

class ValidationException extends \Exception {

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $messages;

    public function __construct(MessageBag $messages) {
        $this->messages = $messages;
    }

    /**
     * @return MessageBag
     */
    public function getAllMessages()
    {
        return $this->messages;
    }

} 