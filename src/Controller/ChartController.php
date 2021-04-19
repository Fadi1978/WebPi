<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use App\Repository\SujetRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartController extends AbstractController
{
    /**
     * @Route("/chart", name="chart", methods={"GET"})
     */
    public function indexAction(CommentaireRepository $commentaireRepository, SujetRepository $sujetRepository)
    {
        $commentaires = $commentaireRepository->findAll();
        $sujets = $sujetRepository->findAll();

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Gestion Commentaires', 'Number per section'],
                ['Number of Commentairs',     count($commentaires)],
                ['Number of Sujets',     count($sujets)],


            ]
        );

        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(700);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        //char2
/*
        $star1 = $hotelRepository->findBy(
            ['stars' => '1']);

        $star2 = $hotelRepository->findBy(
            ['stars' => '2']);

        $star3 = $hotelRepository->findBy(
            ['stars' => '3']);

        $star4 = $hotelRepository->findBy(
            ['stars' => '4']);

        $star5 = $hotelRepository->findBy(
            ['stars' => '5']);

        $star6 = $hotelRepository->findBy(
            ['stars' => '6']);

        $star7 = $hotelRepository->findBy(
            ['stars' => '7']);

        $bar = new BarChart();
        $bar->getData()->setArrayToDataTable(
            [['', ''],
                ['1 stars',     count($star1)],
                ['2 stars',     count($star2)],
                ['3 stars',     count($star3)],
                ['4 stars',     count($star4)],
                ['5 stars',     count($star5)],
                ['6 stars',     count($star6)],
                ['7 stars',     count($star7)]



            ]
        );

        $bar->getOptions()->getHAxis()->setMinValue(0);
        $bar->getOptions()->setWidth(400);
        $bar->getOptions()->setHeight(500);



*/

        return $this->render('/chart/index.html.twig', [
           'pieChart' => $pieChart,

           // 'barchart' => $bar,

        ]);
    }

}