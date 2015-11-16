# NumNum
__Note:__ The puzzle is not mine.
## The Puzzle
Ella is a math nerd. She noticed that her 9-digit Social Security number was the only one that could fit a specific pattern:
* Each of the 9 digits are unique
* No digit is '0'
* The first digit on the left is evenly divisible by 1
* The first two digits on the left are evenly divisible by 2
* The first three digits on the left are evenly divisibly by 3
* ... and so on ...
* The first nine digits on the left are evenly divisible by 9

There is only one number between 111,111,111 and 999,999,999 that fulfills these requirements, what is it?

## The Problem with Trying Every Number

I first tried a brute force check of all numbers between the 9-digit min and the 9-digit max. This took over 20 minutes on my laptop. This generated much heat.

This algorithm is used in the `bruteForce` branch.

Surely there's a better way?

## An Answer
Rather than waste time on numbers that we already know are bad, I decided to discard those numbers from the pool. To do this, I built up the possible numbers one place at a time and discarded those that did not follow the rules, and just kept building and checking.

So, let's start with the 3rd pass of building up the numbers. My known good under 20 (for the sake of brevity) are [12, 14, 16, 18]. That already knocks out [100 - 119, 130-139, 150-159, 170-179, 190-199]. So, I take the '12' and make it '121', which doesn't fit; '12' -> '122' doesn't fit. '12' -> '123' fits, so it gets added to a new pool of known-good. '124', & '125' don't fit, but '126' does, so it gets added to the same new pool of known-good. Keep doing this until the pool of known-good 3-digit numbers is filled. Then base the 4th pass off of those numbers.

This algorithm is used in the `faster` branch.
