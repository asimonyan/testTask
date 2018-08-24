<?php

namespace AppBundle\Services;

use AppBundle\Entity\Credit;
use AppBundle\Entity\Schedule;
use Doctrine\ORM\EntityManager;

/**
 * Class MainService
 * @package AppBundle\Services
 */
class MainService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * MainService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Credit $credit
     * @return array
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function calculateSchedule(Credit $credit)
    {
        $result = [];

        $percentForMonth = ($credit->getPercent() / 12) / 100;

        /**
         * Formula for calculate annuity credit
         *
         * (i * (1 + i ) ^n) / ((1 + i) ^ n - 1)
         *
         */
        $annuityRate =
            ($percentForMonth * pow((1 + $percentForMonth), $credit->getDuration()))
            /
            (pow(( 1 + $percentForMonth), $credit->getDuration()) - 1);

        $paymentPayMonth = $annuityRate * $credit->getSum();
        $paymentPayMonth = round($paymentPayMonth,2);

        $startDate = new \DateTime($credit->getFirstPayment(), new \DateTimeZone('UTC'));

        $endDate = clone $startDate;
        $endDate = $endDate->modify("+ {$credit->getDuration()} month");

        $interval = \DateInterval::createFromDateString('1 month');
        $period = new \DatePeriod($startDate, $interval, $endDate);

        $sum = $credit->getSum();
        $paymentNumber = 1;
        foreach ($period as $p) {
            $percent = $sum * $percentForMonth;
            $mainDebt = $paymentPayMonth - $percent;
            $remainDebt = $sum - $mainDebt;
            $remainDebt = $remainDebt < 0  ? 0 : $remainDebt;

            $schedule = new Schedule();
            $schedule->setCredit($credit);

            $schedule->setPaymentDate($p);
            $schedule->setPaymentNumber($paymentNumber ++);
            $schedule->setMainDebt($mainDebt);
            $schedule->setPercent($percent);
            $schedule->setTotalAmount($paymentPayMonth);
            $schedule->setBalance($remainDebt);

            $result[] = $schedule->toArray(['credit']);

            $this->em->persist($schedule);

            if($paymentNumber % 50 == 0){
                    $this->em->flush();
                    $this->em->clear();
            }

            $sum -= $mainDebt;
        }

        $this->em->flush();

        return $result;
    }
}