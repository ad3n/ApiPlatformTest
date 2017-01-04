<?php

namespace AppBundle\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class TransactionStatus
{
    const PENDING = 'pending';
    const WAITING_FOR_PAYMENT = 'waiting_for_payment';
    const PAYMENT_SUCCESS = 'payment_success';
    const ORDER_SUPPLIER = 'order_supplier';
    const DELIVERING = 'delivering';
    const COMPLETE = 'complete';
    const CANCEL = 'cancel';
}
