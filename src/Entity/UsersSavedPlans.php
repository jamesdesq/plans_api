<?php

namespace App\Entity;

use App\Repository\UsersSavedPlansRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersSavedPlansRepository::class)
 */
class UsersSavedPlans
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plan_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $billing_frequency;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPlanCode(): ?string
    {
        return $this->plan_code;
    }

    public function setPlanCode(string $plan_code): self
    {
        $this->plan_code = $plan_code;

        return $this;
    }

    public function getBillingFrequency(): ?string
    {
        return $this->billing_frequency;
    }

    public function setBillingFrequency(string $billing_frequency): self
    {
        $this->billing_frequency = $billing_frequency;

        return $this;
    }
}
