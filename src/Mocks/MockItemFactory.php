<?php

namespace App\Mocks;

use App\Data\Collections\RuleEntityCollection;
use App\Data\Entities\ItemEntity;
use App\Data\Entities\RuleEntity;

class MockItemFactory
{
    /**
     * Mock database entries for rules
     *
     * @var array - [
     *    condition,
     *    sellInCriteria,
     *    qualityChangeRate
     *    sellInCriteriaRange
     * ]
     */
    private array $rules = [
        'normal' => [
            ['greaterThan', 0, -1],
            ['lessThanEqualTo', 0, -2],
        ],
        'Aged Brie' => [
            ['greaterThan', 0, 1],
            ['lessThanEqualTo', 0, 2],
        ],
        'Sulfuras, Hand of Ragnaros' => [
            ['none', 0, 0]
        ],
        'Backstage passes to a TAFKAL80ETC concert' => [
            ['greaterThan', 10, 1],
            ['between', 10, 2, 6],
            ['between', 5, 3, 1],
            ['endOnSellInDay', 0, 0]
        ],
        'Conjured Mana Cake' => [
            ['greaterThan', 0, -2],
            ['lessThanEqualTo', 0, -4]
        ]
    ];

    /**
     * @param string $name
     * @param int $quality
     * @param int $sellIn
     * @return ItemEntity[]
     */
    public function itemWithRules(string $name, int $quality, int $sellIn): array
    {
        return [
            new ItemEntity($name, $quality, $sellIn, new RuleEntityCollection($this->getRuleEntitiesByName($name)))
        ];
    }

    /**
     * @param string $name
     * @return array
     */
    private function getRuleEntitiesByName(string $name): array
    {
        $rules = [];

        foreach ($this->rules[$name] as $rule) {
            $rules[] = new RuleEntity(
                0, // Just set the Entity ID to zero for mock purposes
                $rule[1], // $sellInCriteria
                $rule[2], // $qualityChangeRate
                $rule[0], // $condition
                $rule[3] ?? null // $sellInCriteriaRange
            );
        }

        return $rules;
    }
}