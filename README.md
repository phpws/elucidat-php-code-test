# The Elucidat 'Gilded Rose' Coding Test

## The task

This repository includes the initial setup for a Gilded Rose kata.  It includes everything you need to get up and running, including a large suite of tests.  The purpose of this task is to put you in the position of having some old, ugly, legacy code and seeing whay you could do with it, all of the while making any of your changes test-driven and ensuring everything continues to pass the tests (or any more tests you would write). 

Please follow the specifications below, refactoring as you see fit.  However, please keep the following in mind:

- All the of tests are expected to pass
- You will need to uncomment the tests for the new item type
- Any new code you write should be covered by tests if it's not already
- Keep good design principles in mind when you refactor the code
- You only need to spend an hour or two on this

## Getting started

Run:

```
composer update
```

to install the testing framework (we're using [Kahlan library](http://kahlan.readthedocs.org/en/latest/) here as it has a very easy-to-understand spec perfect for this small exercise), and to run the tests use:

```
./vendor/bin/kahlan
```

## Specifications

Hi and welcome to team Gilded Rose. As you know, we are a small inn with a prime location in a
prominent city ran by a friendly innkeeper named Allison. We also buy and sell only the finest goods.

Unfortunately, our goods are constantly degrading in quality as they approach their sell by date. We
have a system in place that updates our inventory for us. It was developed by a no-nonsense type named Leeroy, who has moved on to new adventures. Your task is to add the new item to our system so that we can begin selling a new category of items. First an introduction to our system:

- All items have a SellIn value which denotes the number of days we have to sell the item
- All items have a Quality value which denotes how valuable the item is
- At the end of each day our system lowers both values for every item

Pretty simple, right? Well this is where it gets interesting:

- Once the sell by date has passed, Quality degrades twice as fast
- The Quality of an item is never negative
- "Aged Brie" actually increases in Quality the older it gets
- The Quality of an item is never more than 50
- "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
- "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches; Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but Quality drops to 0 after the concert

We have recently signed a supplier of conjured items. This requires an update to our system:

- "Conjured" items degrade in Quality twice as fast as normal items

Feel free to make any changes to the `nextDay` method and add any new code as long as everything
still works correctly. However, do not alter the `Item` class or `items` property as those belong to the goblin in the corner who will insta-rage you as he doesn't believe in shared code ownership (you can make the `nextDay` method and `items` property static if you like, we'll cover for you).

Just for clarification, an item can never have its Quality increase above 50, however "Sulfuras" is a legendary item and as such its Quality is 80 and it never alters.

## Implementation

The first thing I thought when looking at the task was, what happens when the list of Items grows to 1000+
with at least 25% of them having custom rules.

1. The code would become unmanageable
2. This would be expensive for the business to get a developer to add a new item each time and update code

So my solution was to redo the architectural design so that the rules would come from a database, with a One to Many
relationship between and Item and Rules table.

Each item can have multiple rules as demonstrated in MockItemFactory.php

Follow up work to this would be to create an Admin section to the website that would make it possible for a product 
manager to add items and rules to the system with-out requiring a developer, it could also be possible to create
functionality that would allow the admin user to run a simulation so that the rules they entered are run and output is 
generated showing them how the sellIn value and Quality would change over a specified period of time, say 30 days
this would allow the admin to review that their configuration is going to work as expected, possibly saving the need for
a dev to write functional tests and also passes the responsibility back to the product owner.