<?php

namespace App;

use App\Helpers\RuleRunner;
use App\Data\Entities\ItemEntity;

class GildedRose
{
    /**
     * @var ItemEntity[]
     */
    private array $items;

    /**
     * GildedRose constructor.
     *
     * @param ItemEntity[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param int|null $which
     * @return ItemEntity|ItemEntity[]
     */
    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    /**
     * @return void
     *
     * note: there seems to be a bug with Kahlan testing package, it is not possible to use a return
     * type of :void in the function declaration. Kahlan errors saying
     *
     * PHP Fatal error:  A void function must not return a value when no value is being returned.
     */
    public function nextDay()
    {
        foreach ($this->items as $item) {
            (new RuleRunner($item))->runRules();
        }
    }
}
