<?php

namespace App\Command;

use App\Entity\Secli;
use App\Service\ConvertCsvToArray;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:imp-secli',
    description: 'Charge le fichier secli.csv en base de données',
)]
class ImpSecliCommand extends Command
{
    public function __construct(
        private ConvertCsvToArray $convertCsvToArray,
        private EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Import du fichier SECLI.');

        $now = new \DateTime('NOW');
        $io->text('Lancement du script : '.$now->format('d-m-Y G:i:s'));

        $data = $this->get($input, $output);

        $io->progressStart(count($data));

        foreach ($data as $row) {
            $secli = new Secli();

            $secli->setTitre($row['titre']);

            $secli->setAnnee($row['annee']);

            $secli->setCote($row['cote']);

            $secli->setCoteNew(null);
            if (strlen($row['coteNew']) > 0) {
                $secli->setCoteNew($row['coteNew']);
            }

            $secli->setAuteur(null);
            if (strlen($row['auteur']) > 0) {
                $secli->setAuteur($row['auteur']);
            }

            $secli->setCompositeur(null);
            if (strlen($row['compositeur']) > 0) {
                $secli->setCompositeur($row['compositeur']);
            }

            $secli->setEditeur(null);
            if (strlen($row['editeur']) > 0) {
                $secli->setEditeur($row['editeur']);
            }

            $secli->setFiche(0);
            if (strlen($row['fiche']) > 0) {
                $secli->setFiche($row['fiche']);
            }

            $secli->setSnpls(null);
            if (strlen($row['snpls']) > 0) {
                $secli->setSnpls($row['snpls']);
            }

            $secli->setImporte(false);

            $this->entityManager->persist($secli);

            $io->progressAdvance();
        }

        $this->entityManager->flush();

        $io->progressFinish();

        $now = new \DateTime('NOW');
        $io->text('Fin du script       : '.$now->format('d-m-Y G:i:s'));

        $io->success('Import du fichier SECLI terminé');

        return Command::SUCCESS;
    }

    protected function get(InputInterface $input, OutputInterface $output): array
    {
        $fileName = 'secli.csv';
        $data = $this->convertCsvToArray->convert($fileName, ';');

        return $data;
    }
}
