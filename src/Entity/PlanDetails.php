<?php

namespace App\Entity;

use App\Repository\PlanDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanDetailsRepository::class)
 */
class PlanDetails
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
    private $plan_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $monthly_cost;

    /**
     * @ORM\Column(type="integer")
     */
    private $annual_cost;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMonthlyCost(): ?int
    {
        return $this->monthly_cost;
    }

    public function setMonthlyCost(int $monthly_cost): self
    {
        $this->monthly_cost = $monthly_cost;

        return $this;
    }

    public function getAnnualCost(): ?int
    {
        return $this->annual_cost;
    }

    public function setAnnualCost(int $annual_cost): self
    {
        $this->annual_cost = $annual_cost;

        return $this;
    }
}
