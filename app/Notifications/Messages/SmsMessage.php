<?php

namespace App\Notifications\Messages;

class SmsMessage
{
    private string $_recipient;
    private string $_content;

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->_recipient;
    }

    /**
     * @param string $recipient
     * @return $this
     */
    public function setRecipient(string $recipient)
    {
        $this->_recipient = $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->_content = $content;
        return $this;
    }
}
