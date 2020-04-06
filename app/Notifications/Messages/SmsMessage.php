<?php

namespace App\Notifications\Messages;

class SmsMessage
{
    private $_recipient;
    private $_content;

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->_recipient;
    }

    /**
     * @param mixed $recipient
     * @return SmsMessage
     */
    public function setRecipient($recipient)
    {
        $this->_recipient = $recipient;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param mixed $content
     * @return SmsMessage
     */
    public function setContent($content)
    {
        $this->_content = $content;
        return $this;
    }
}
