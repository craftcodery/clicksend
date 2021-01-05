<?php

namespace CraftCodery\ClickSend\Traits;

trait CanReceiveMailers
{
    /**
     * Get the recipient's address for ClickSend mailers.
     *
     * @return array
     */
    abstract public function mailerRecipientAddress();
}
