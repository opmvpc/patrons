<?php
namespace Opmvpc\Patrons\Tests\Behavioral\Observer;

use Opmvpc\Patrons\Behavioral\Observer\Invoice;
use Opmvpc\Patrons\Behavioral\Observer\Reporting;
use Opmvpc\Patrons\Behavioral\Observer\SendInvoiceUpdate;
use PHPUnit\Framework\TestCase;

class ObserverTest extends TestCase
{
    public function test_invoice_state()
    {
        $invoice = new Invoice();
        $invoice->setAttribute('id', 1234);
        $this->assertEquals(1234, $invoice->getAttribute('id'));
        $invoice->setAttribute('total', 200.0);
        $this->assertEquals(
            [
                'id' => 1234,
                'total' => 200.0,
        ],
            $invoice->getState()
        );
    }

    /** @test */
    public function it_notifies_changes_to_observers()
    {
        $reportingObserver = new Reporting();
        $sendInvoiceObserver = new SendInvoiceUpdate();

        $invoice = new Invoice();
        $invoice->setAttribute('id', 1234);
        $invoice->attach($reportingObserver);
        $invoice->attach($sendInvoiceObserver);

        $invoice->setAttribute('total', 200.0);

        $this->assertCount(1, $reportingObserver->getNotifiers());
        $this->assertCount(1, $sendInvoiceObserver->getNotifiers());
    }

    /** @test */
    public function it_can_detatch_observers()
    {
        $reportingObserver = new Reporting();
        $sendInvoiceObserver = new SendInvoiceUpdate();

        $invoice = new Invoice();
        $invoice->setAttribute('id', 1234);
        $invoice->attach($reportingObserver);
        $invoice->attach($sendInvoiceObserver);

        $invoice->detach($sendInvoiceObserver);


        $invoice->setAttribute('total', 200.0);

        $this->assertCount(1, $reportingObserver->getNotifiers());
        $this->assertCount(0, $sendInvoiceObserver->getNotifiers());
    }

    /** @test */
    public function it_does_not_update_if_value_is_the_same()
    {
        $reportingObserver = new Reporting();

        $invoice = new Invoice();
        $invoice->setAttribute('id', 1234);
        $invoice->attach($reportingObserver);

        $invoice->setAttribute('id', 1234);

        $this->assertCount(0, $reportingObserver->getNotifiers());

        $invoice->setAttribute('id', 3333);

        $this->assertCount(1, $reportingObserver->getNotifiers());
    }
}
