<?php

namespace App\Tests\Entity;

use App\Entity\Artiste;
use PHPUnit\Framework\TestCase;

class ArtisteTest extends TestCase
{
    public function testGetId(): void
    {
        $Artiste = new Artiste();
        $this->assertNull($Artiste->getId());
    }

    public function testCivilite(): void
    {
        $Artiste = new Artiste();
        $Artiste->setCivilite('Mme');
        $this->assertSame('Mme', $Artiste->getCivilite());
    }

    public function testFirstName(): void
    {
        $Artiste = new Artiste();
        $Artiste->setFirstName('John');
        $this->assertSame('John', $Artiste->getFirstName());
    }

    public function testLastName(): void
    {
        $Artiste = new Artiste();
        $Artiste->setLastName('Doe');
        $this->assertSame('Doe', $Artiste->getLastName());
    }

    public function testDateNaiss(): void
    {
        $Artiste = new Artiste();
        $Artiste->setDateNaiss('31/10/1920');
        $this->assertSame('31/10/1920', $Artiste->getDateNaiss());
    }

    public function testDateDeces(): void
    {
        $Artiste = new Artiste();
        $Artiste->setDateDeces('08/08/2008');
        $this->assertSame('08/08/2008', $Artiste->getDateDeces());
    }
}