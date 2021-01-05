<?php

namespace CraftCodery\ClickSend\Contracts;

interface CanReceiveMailers
{
    /**
     * Get the recipient's address for ClickSend mailers.
     *
     * @return array
     */
    public function mailerRecipientAddress();
}
