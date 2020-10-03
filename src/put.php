<?php

declare(strict_types = 1);

namespace Phelpers;

use InvalidArgumentException;

/**
 * @param array|object $subject The subject to set a value on by a given key/property name
 * @param string $path The index, key, property, or dot separated path name to set a value at
 * @param mixed $value The value to be set
 * @return void
 */
function put(&$subject, string $path, $value): void {
    $isArray = \is_array($subject);
    $object = null;
    
    if (!\is_object($subject) and !$isArray) {
        throw new InvalidArgumentException(\sprintf('Argument 1 passed to %s must be of the type %s, %s given', __FUNCTION__, 'array|object', \gettype($subject)));
    }
    
    if (!$isArray) {
        $object = $subject;
    }
    
    $segments = \explode(".", $path);
    
    while (\count($segments) > 1) {
        $segment = \array_shift($segments);

        if (\is_array($subject)) {
            if (!isset($subject[$segment]) or !\is_array($subject[$segment])) {
                $subject[$segment] = [];
            }

            $subject = &$subject[$segment];
        }

        if (\is_object($object)) {
            if (!isset($subject->{$segment}) or !\is_object($subject->{$segment})) {
                $object->{$segment} = (object) [];
            }

            $object = &$object->{$segment};
        }
    }

    if ($isArray) {
        $subject[array_shift($segments)] = $value;
        
        return;
    }

    $object->{array_shift($segments)} = $value;
}
