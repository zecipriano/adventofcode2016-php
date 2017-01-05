<?php

namespace AdventOfCode2016\Day17;

class Floor
{
    public function getOpenDoors(string $path) : array
    {
        $doors = substr(md5($path), 0, 4);
        $openDoors = [];
        $meansOpen = ['b', 'c', 'd', 'e', 'f'];

        // Up
        if (in_array($doors[0], $meansOpen)) {
            $openDoors[] = 'U';
        }

        // Down
        if (in_array($doors[1], $meansOpen)) {
            $openDoors[] = 'D';
        }

        // Left
        if (in_array($doors[2], $meansOpen)) {
            $openDoors[] = 'L';
        }

        // Right
        if (in_array($doors[3], $meansOpen)) {
            $openDoors[] = 'R';
        }

        return $openDoors;
    }
}
