<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity()
 * @ORM\Table(name="credit")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Credit
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min = 1)
     * @ORM\Column(name="sum", type="integer")
     */
    private $sum;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min = 1)
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min = 1)
     * @ORM\Column(name="percent", type="integer")
     */
    private $percent;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="firstPayment", type="string")
     */
    private $firstPayment;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Schedule", mappedBy="schedules", cascade={"persist", "remove"})
     */
    protected $schedules;

    /**
     * Credit constructor.
     * @param array $properties
     */
    public function __construct(array $properties = [])
    {
        foreach ($properties as $property => $value){
            $this->{$property} = $value;
        }

        return $this;
    }

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
     * Add schedule
     *
     * @param \AppBundle\Entity\Schedule $schedule
     *
     * @return Credit
     */
    public function addSchedule(\AppBundle\Entity\Schedule $schedule)
    {
        $this->schedules[] = $schedule;
        $schedule->setCredit($this);

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \AppBundle\Entity\Schedule $schedule
     */
    public function removeSchedule(\AppBundle\Entity\Schedule $schedule)
    {
        $this->schedules->removeElement($schedule);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * Set sum
     *
     * @param integer $sum
     *
     * @return Credit
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum
     *
     * @return integer
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Credit
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set percent
     *
     * @param integer $percent
     *
     * @return Credit
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
     * Set firstPayment
     *
     * @param \DateTime $firstPayment
     *
     * @return Credit
     */
    public function setFirstPayment($firstPayment)
    {
        $this->firstPayment = $firstPayment;

        return $this;
    }

    /**
     * Get firstPayment
     *
     * @return \DateTime
     */
    public function getFirstPayment()
    {
        return $this->firstPayment;
    }
}
