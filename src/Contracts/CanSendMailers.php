<?php

namespace CraftCodery\ClickSend\Contracts;

interface CanSendMailers
{
    /**
     * Get the sender's return address for ClickSend mailers.
     *
     * @return array
     */
    public function mailerReturnAddress();
}
