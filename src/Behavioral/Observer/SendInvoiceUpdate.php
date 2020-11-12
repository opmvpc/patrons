<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Observer;

use SplSubject;

class SendInvoiceUpdate extends Observer
{
    public function update(SplSubject $subject): void
    {
        parent::update($subject);
        // Example: Send the new version of the invoice by email
        // $this->sendInvoice($subject->getState());
    }
}
