<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="schedule")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="payment_number", type="integer")
     */
    protected $paymentNumber;

    /**
     * @ORM\Column(name="payment_date", type="date")
     */
    protected $paymentDate;

    /**
     * @ORM\Column(name="main_debt", type="decimal", scale=2)
     */
    protected $mainDebt;

    /**
     * @ORM\Column(name="percent", type="integer")
     */
    protected $percent;

    /**
     * @ORM\Column(name="total_amount", type="decimal", scale=2)
     */
    protected $totalAmount;

    /**
     * @ORM\Column(name="balance", type="decimal", scale=2)
     */
    protected $balance;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Credit", inversedBy="schedules", cascade={"persist"})
     * @ORM\JoinColumn(name="credit_id", referencedColumnName="id")
     */
    protected $credit;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set paymentNumber
     *
     * @param integer $paymentNumber
     *
     * @return Schedule
     */
    public function setPaymentNumber($paymentNumber)
    {
        $this->paymentNumber = $paymentNumber;

        return $this;
    }

    /**
     * Get paymentNumber
     *
     * @return integer
     */
    public function getPaymentNumber()
    {
        return $this->paymentNumber;
    }

    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     *
     * @return Schedule
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Get paymentDate
     *
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set mainDebt
     *
     * @param string $mainDebt
     *
     * @return Schedule
     */
    public function setMainDebt($mainDebt)
    {
        $this->mainDebt = $mainDebt;

        return $this;
    }

    /**
     * Get mainDebt
     *
     * @return string
     */
    public function getMainDebt()
    {
        return $this->mainDebt;
    }

    /**
     * Set percent
     *
     * @param integer $percent
     *
     * @return Schedule
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return integer
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set totalAmount
     *
     * @param string $totalAmount
     *
     * @return Schedule
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return Schedule
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set credit
     *
     * @param \AppBundle\Entity\Credit $credit
     *
     * @return Schedule
     */
    public function setCredit(\AppBundle\Entity\Credit $credit = null)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return \AppBundle\Entity\Credit
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Entity to array
     *
     * @return array
     */
    public function toArray()
    {
       return [
           'paymentNumber' => $this->getPaymentNumber(),
           'paymentDate' => $this->getPaymentDate() ? $this->getPaymentDate()->format('Y-m') : null,
           'mainDebt' => $this->getMainDebt(),
           'percent' => $this->getPercent(),
           'totalAmount' => $this->getTotalAmount(),
           'balance' => $this->getBalance()
       ];
    }
}
