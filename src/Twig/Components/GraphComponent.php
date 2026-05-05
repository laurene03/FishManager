<?php

namespace App\Twig\Components;

use App\Repository\ReleveRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart as ModelChart;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use \DateTime;

#[AsLiveComponent]
final class GraphComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $period = 'month';

    #[LiveProp(writable: true)]
    public string $activeFilter = 'temperature';

    public function __construct(
        private ChartBuilderInterface $chartBuilder,
        private ReleveRepository $releveRepository,
        private Security $security
    ) {}

    #[ExposeInTemplate]
    public function getChart() {
        $chart = $this->chartBuilder->createChart(ModelChart::TYPE_LINE);
        
        // Récupérer les données en fonction de la période
        $data = $this->getDataByPeriod();
        
        $datasets = [];
        $yAxisConfig = [
            'type' => 'linear',
            'display' => true,
            'beginAtZero' => true,
        ];
        
        // Construire le graphique en fonction du filtre actif
        switch ($this->activeFilter) {
            case 'hardness':
                // Dureté (GH et KH)
                $datasets = [
                    [
                        'label' => 'GH (Dureté générale) - °dGH',
                        'borderColor' => 'rgb(255, 99, 132)',
                        'backgroundColor' => 'rgba(255, 99, 132, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(255, 99, 132)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['gH'],
                    ],
                    [
                        'label' => 'KH (Alcalinité) - °dKH',
                        'borderColor' => 'rgb(54, 162, 235)',
                        'backgroundColor' => 'rgba(54, 162, 235, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(54, 162, 235)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['kH'],
                    ],
                ];
                $yAxisConfig['suggestedMin'] = 0;
                $yAxisConfig['suggestedMax'] = 20;
                break;
                
            case 'pH':
                $datasets = [
                    [
                        'label' => 'pH',
                        'borderColor' => 'rgb(75, 192, 75)',
                        'backgroundColor' => 'rgba(75, 192, 75, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(75, 192, 75)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['pH'],
                    ],
                ];
                $yAxisConfig['suggestedMin'] = 0;
                $yAxisConfig['suggestedMax'] = 14;
                break;
                
            case 'temperature':
                $datasets = [
                    [
                        'label' => 'Température (°C)',
                        'borderColor' => 'rgb(255, 159, 64)',
                        'backgroundColor' => 'rgba(255, 159, 64, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(255, 159, 64)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['temperature'],
                    ],
                ];
                $yAxisConfig['suggestedMin'] = 15;
                $yAxisConfig['suggestedMax'] = 35;
                break;
                
            case 'CO2':
                $datasets = [
                    [
                        'label' => 'CO2 dissous (mg/L)',
                        'borderColor' => 'rgb(153, 102, 255)',
                        'backgroundColor' => 'rgba(153, 102, 255, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(153, 102, 255)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['CO2'],
                    ],
                ];
                $yAxisConfig['suggestedMin'] = 0;
                $yAxisConfig['suggestedMax'] = 100;
                break;
                
            case 'nitrogen':
                // Azote (Nitrate et Nitrite)
                $datasets = [
                    [
                        'label' => 'Nitrate (NO3) - mg/L',
                        'borderColor' => 'rgb(255, 206, 86)',
                        'backgroundColor' => 'rgba(255, 206, 86, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(255, 206, 86)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['nitrate'],
                    ],
                    [
                        'label' => 'Nitrite (NO2) - mg/L',
                        'borderColor' => 'rgb(201, 203, 207)',
                        'backgroundColor' => 'rgba(201, 203, 207, 0.1)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                        'pointRadius' => 5,
                        'pointBackgroundColor' => 'rgb(201, 203, 207)',
                        'pointBorderColor' => '#fff',
                        'pointBorderWidth' => 2,
                        'data' => $data['nitrite'],
                    ],
                ];
                $yAxisConfig['suggestedMin'] = 0;
                $yAxisConfig['suggestedMax'] = 200;
                break;
        }

        $chart->setData([
            'labels' => $data['labels'],
            'datasets' => $datasets,
        ]);

        $chart->setOptions([
            'responsive' => true,
            'maintainAspectRatio' => true,
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => $yAxisConfig,
                'x' => [
                    'display' => true,
                ],
            ],
        ]);

        return $chart;
    }

    #[LiveAction]
    public function filterTemperature(): void
    {
        $this->activeFilter = 'temperature';
    }

    #[LiveAction]
    public function filterPH(): void
    {
        $this->activeFilter = 'pH';
    }

    #[LiveAction]
    public function filterCO2(): void
    {
        $this->activeFilter = 'CO2';
    }

    #[LiveAction]
    public function filterHardness(): void
    {
        $this->activeFilter = 'hardness';
    }

    #[LiveAction]
    public function filterNitrogen(): void
    {
        $this->activeFilter = 'nitrogen';
    }

    private function getDataByPeriod(): array
    {
        $now = new DateTime();
        $startDate = new DateTime();
        
        // Déterminer la date de début selon la période sélectionnée
        switch ($this->period) {
            case 'month':
                // Premier jour du mois actuel
                $startDate->modify('first day of this month');
                break;
            case 'quarter':
                // Premier jour du trimestre actuel
                $currentMonth = (int)$now->format('m');
                $quarter = (int)ceil($currentMonth / 3);
                $firstMonthOfQuarter = ($quarter - 1) * 3 + 1;
                $startDate = new DateTime($now->format('Y') . '-' . str_pad($firstMonthOfQuarter, 2, '0', STR_PAD_LEFT) . '-01');
                break;
            case 'year':
                // Premier jour de l'année actuelle
                $startDate = new DateTime($now->format('Y') . '-01-01');
                break;
            default:
                // Par défaut: ce mois
                $startDate->modify('first day of this month');
        }
        
        // Récupérer TOUS les relevés
        $allReleves = $this->releveRepository->findAll();
        
        // Filtrer par période et trier par date
        $relevesToDisplay = [];
        foreach ($allReleves as $releve) {
            if ($releve->getDate() !== null && $releve->getDate() >= $startDate && $releve->getDate() <= $now) {
                $relevesToDisplay[] = $releve;
            }
        }
        
        // Trier par date
        usort($relevesToDisplay, function($a, $b) {
            return $a->getDate() <=> $b->getDate();
        });
        
        // Formater les données pour le graphique
        $labels = [];
        $temperatures = [];
        $pHs = [];
        $CO2s = [];
        $gHs = [];
        $kHs = [];
        $nitrates = [];
        $nitrites = [];
        
        foreach ($relevesToDisplay as $releve) {
            $labels[] = $releve->getDate()->format('d/m/Y H:i');
            $temperatures[] = !empty($releve->getTemperature()) ? (float)$releve->getTemperature() : 0;
            $pHs[] = !empty($releve->getPH4()) ? (float)$releve->getPH4() : 0;
            $CO2s[] = !empty($releve->getCO2dissous()) ? (float)$releve->getCO2dissous() : 0;
            $gHs[] = !empty($releve->getGH()) ? (float)$releve->getGH() : 0;
            $kHs[] = !empty($releve->getKH()) ? (float)$releve->getKH() : 0;
            $nitrates[] = !empty($releve->getNitrate()) ? (float)$releve->getNitrate() : 0;
            $nitrites[] = !empty($releve->getNitrite()) ? (float)$releve->getNitrite() : 0;
        }
        
        // Si pas de données, retourner un graphique vide
        if (empty($labels)) {
            $labels = ['Aucune donnée'];
            $temperatures = [null];
            $pHs = [null];
            $CO2s = [null];
            $gHs = [null];
            $kHs = [null];
            $nitrates = [null];
            $nitrites = [null];
        }
        
        return [
            'labels' => $labels,
            'temperature' => $temperatures,
            'pH' => $pHs,
            'CO2' => $CO2s,
            'gH' => $gHs,
            'kH' => $kHs,
            'nitrate' => $nitrates,
            'nitrite' => $nitrites,
        ];
    }
}


