<?php

namespace App\Tests\Entity;

use App\Entity\Chant;
use App\Entity\Editeur;
use PHPUnit\Framework\TestCase;

class ChantTest extends TestCase
{
    public function testGetId(): void
    {
        $chant = new Chant();
        $this->assertNull($chant->getId());
    }

    public function testTitre(): void
    {
        $chant = new Chant();
        $chant->setTitre('Mme');
        $this->assertSame('Mme', $chant->getTitre());
    }

    public function testAnnee(): void
    {
        $chant = new Chant();
        $chant->setAnnee(1999);
        $this->assertSame(1999, $chant->getAnnee());
    }

    public function testCote(): void
    {
        $chant = new Chant();
        $chant->setCote('AL179');
        $this->assertSame('AL179', $chant->getCote());
    }

    public function testCoteNew(): void
    {
        $chant = new Chant();
        $chant->setCoteNew('RT146-1');
        $this->assertSame('RT146-1', $chant->getCoteNew());
    }

    public function testSnpls(): void
    {
        $chant = new Chant();
        $chant->setSnpls('2005+2013');
        $this->assertSame('2005+2013', $chant->getSnpls());
    }

    public function testSource(): void
    {
        $chant = new Chant();
        $chant->setSource('Psaume 77');
        $this->assertSame('Psaume 77', $chant->getSource());
    }
    
    public function testSecli(): void
    {
        $chant = new Chant();
        $chant->setSecli(168);
        $this->assertSame(168, $chant->getSecli());
    }

    public function testOrdinaire(): void
    {
        $chant = new Chant();
        $chant->setOrdinaire(true);
        $this->assertSame(true, $chant->isOrdinaire());
    }
    
    public function testTexte(): void
    {
        $chant = new Chant();
        $valeur = "<p>1.&nbsp;Approchons-nous de la table<br />O&ugrave; le Christ va s&#39;offrir parmi nous.<br />Offrons-lui ce que nous sommes<br />Car le Christ va nous transformer en lui.</p>";

        $chant->setTexte($valeur);
        $this->assertSame($valeur, $chant->getTexte());
    }

    public function testEditeur(): void
    {
        $chant = new Chant();
        $editeur = new Editeur();

        $chant->setEditeur($editeur);
        $this->assertSame($editeur, $chant->getEditeur());
    }
}