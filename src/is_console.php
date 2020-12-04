<?php

declare(strict_types = 1);

/**
 * This file is part of the jordanbrauer/phelpers PHP library.
 *
 * @copyright 2020 Jordan Brauer <18744334+jordanbrauer@users.noreply.github.com>
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phelpers;

/**
 * Determine if the program is being ran through a CLI.
 *
 * @return bool
 */
function is_console(): bool
{
    return \in_array(read(runtime('interface'), 'interface', 'cli'), ['cli', 'phpdbg'], true);
}
