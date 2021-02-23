<?php
/**
 * @license MIT
 * @author hazuki3417<hazuki3417@gmail.com>
 * @copyright 2021 hazuki3417 all rights reserved.
 */

namespace Selen\Environment;

/**
 * Interface that implements the setting name and setting value of the deployment environment
 */
interface TypeInterface
{
    /**
     * Get the environment name
     *
     * @return string Returns the environment name
     */
    public function name(): string;

    /**
     * Get the setting value
     *
     * @return array Returns the set value
     */
    public function values(): array;
}
