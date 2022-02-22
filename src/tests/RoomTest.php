<?php

use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use Campus\UnitTest\Models\Room;

class Roomtest extends TestCase
{
    private \Faker\Generator $kaker;
    private string $name;
    private string $description;
    private Room $room;

    public function setUp(): void
    {
        $this->faker = Faker::create('fr_FR');


        $this->name =  $this->faker->name();
        $this->description = $this->faker->words(20, true);
        $this->room = new Room(
            $this->name,
            $this->description
        );
    }

    public function testCreateRoom()
    {

        $this->assertEquals(ucfirst(strtolower($this->name)), $this->room->getName());
        $this->assertEquals(
            $this->description,
            $this->room->getDescription()
        );
        $this->assertEquals(60, $this->room->getDuration());
    }

    public function testHowManyEnigma()
    {
        $number_enigma = $this->room->getNbEnigma();

        if ($this->room->getLevel() == Room::EASY_LEVEL) {
            $expected_enigma = 5;
        } elseif ($this->room->getLevel() == Room::NORMAL_LEVEL) {
            $expected_enigma = 10;
        } elseif ($this->room->getLevel() == Room::HARD_LEVEL) {
            $expected_enigma = 20;
        }

        $this->assertEquals($expected_enigma, $number_enigma);
    }
}
