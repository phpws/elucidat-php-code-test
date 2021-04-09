<?php

namespace App\Data\Entities;

use App\Item;
use App\Data\Collections\RuleEntityCollection;

/**
 * Class ItemEntity
 *
 * Extend Item class ...
 *
 * Open for Extension Closed for Modification by following the 'O' in SOLID principles.
 *
 * @package App\Data\Entities
 */
class ItemEntity extends Item
{
    /**
     * @var RuleEntityCollection
     */
    private RuleEntityCollection $rules;

    /**
     * ItemEntity constructor.
     *
     * @param string $name
     * @param int $quality
     * @param int $sellIn
     * @param RuleEntityCollection $rules
     */
    public function __construct(string $name, int $quality, int $sellIn, RuleEntityCollection $rules)
    {
        parent::__construct($name, $quality, $sellIn);

        $this->rules = $rules;
    }

    /**
     * @return mixed
     */
    public function getSellIn()
    {
        return $this->sellIn;
    }

    /**
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * @return void
     *
     * note: there seems to be a bug with Kahlan testing package, it is not possible to use a return
     * type of :void in the function declaration. Kahlan errors saying
     *
     * PHP Fatal error:  A void function must not return a value when no value is being returned.
     */
    public function updateSellIn()
    {
        --$this->sellIn;
    }

    /**
     * @param int $quality
     */
    public function setQuality(int $quality)
    {
        $this->quality = $quality;
    }

    /**
     * @param int $newValue
     */
    public function updateQuality(int $newValue)
    {
        // Note: newValue can be a negative value in that case quality will decrease.
        $this->quality += $newValue;

        // Never allow negative values for quality.
        if ($this->quality <= 0) {
            $this->quality = 0;
        }
    }

    /**
     * @return RuleEntityCollection
     */
    public function getRules(): RuleEntityCollection
    {
        return $this->rules;
    }
}