<?php

namespace Tests\Day14;

use AdventOfCode2016\Day14\KeySearcher;
use PHPUnit\Framework\TestCase;

class KeySearcherTest extends TestCase
{
    public function testItSearchesKeys()
    {
        $searcher = new KeySearcher();
        $lastKeyIndex = $searcher->searchKeys('abc', 64);

        $this->assertEquals(22728, $lastKeyIndex);
    }

    /**
     * @dataProvider possibleKeysProvider
     */
    public function testItIdentifiesPossibleKeys(string $hash, $expected)
    {
        $searcher = new KeySearcher();
        $this->assertEquals($expected, $searcher->isPossibleKey($hash));
    }

    /**
     * @dataProvider possibleValidationProvider
     */
    public function testItIdentifiesPossibleKeyValidations(
        string $hash,
        $expected
    ) {
        $searcher = new KeySearcher();
        $this->assertEquals(
            $expected,
            $searcher->isPossibleKeyValidation($hash)
        );
    }

    public function testItStretchesHashes()
    {
        $searcher = new KeySearcher();
        $this->assertEquals(
            'a107ff634856bb300138cac6568c0f24',
            $searcher->getHash('abc0', 2016)
        );
    }

    public function testItSearchesKeysWithHashStretching()
    {
        $searcher = new KeySearcher();
        $lastKeyIndex = $searcher->searchKeys('abc', 64, 2016);

        $this->assertEquals(22551, $lastKeyIndex);
    }

    public static function possibleKeysProvider()
    {
        return [
            ['0034e0923cc38887a57bd7b1d4f953df', '8'],
            ['6ef56b8d791c660573dea373bf88155f', null],
        ];
    }

    public static function possibleValidationProvider()
    {
        return [
            ['3aeeeee1367614f3061d165a5fe3cac3', 'e'],
            ['6ef56b8d791c660573dea373bf88155f', null],
            ['83501e9109999965af11270ef8d61a4f', '9'],
        ];
    }
}
