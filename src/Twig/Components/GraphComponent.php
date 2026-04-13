<?php

namespace App\Twig\Components;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart as ModelChart;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent]
final class GraphComponent
{
    use DefaultActionTrait;

    public function __construct(private ChartBuilderInterface $chartBuilder) {}

    #[ExposeInTemplate]
    public function showChartWeek() {
        $chart = $this->chartBuilder->createChart(ModelChart::TYPE_BAR);

        $chart->setData([
            'labels' => ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
            'datasets' => [
                [
                    'label' => 'Ma semaine',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $chart;
    }
}


