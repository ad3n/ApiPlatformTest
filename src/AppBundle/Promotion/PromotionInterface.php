<?php

namespace AppBundle\Promotion;

use AppBundle\Model\TransactionInterface;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface PromotionInterface
{
    /**
     * @param string $voucherCode
     */
    public function setVoucherCode(string $voucherCode);

    /**
     * @param TransactionInterface $transaction
     */
    public function calculate(TransactionInterface $transaction);
}
