<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;

use App\Models\Municipio;

class ChartController extends Controller
{
    public function index()
    {
        $chart = Charts::multi('area', 'highcharts')
            // Setup the chart settings
            ->title("Título do Gráfico - Bar")
            // A dimension of 0 means it will take 100% of the space
            ->dimensions(0, 400) // Width x Height
            // This defines a preset of colors already done:)
            ->template("material")
            // You could always set them manually
            // ->colors(['#2196F3', '#F44336', '#FFC107'])
            // Setup the diferent datasets (this is a multi chart)
            ->dataset('Elemento 1', [5,20,100])
            ->dataset('Elemento 2', [15,30,80])
            ->dataset('Elemento 3', [25,10,40])
            // Setup what the values mean
            ->labels(['Grupo 1', 'Grupo 2', 'Grupo 3']);

        $chart2 = Charts::multi('line', 'chartjs')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->template("material")
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->dataset('Elemento 1', [5,20,100])
            ->dataset('Elemento 2', [15,30,80])
            ->dataset('Elemento 3', [25,10,40])
            ->labels(['Grupo 1', 'Grupo 2', 'Grupo 3']);
        
        $chart3 = Charts::create('line', 'minimalist')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->values([5,20,100,200])
            ->labels(['BR', 'ES', 'FR','IN']);

        $chart4 = Charts::create('geo', 'google')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->values([5,20,100,200])
            ->labels(['BR', 'ES', 'FR','IN']);

        $chart5 = Charts::create('geo', 'highcharts')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->values([5,20,100,200])
            ->labels(['BR', 'ES', 'FR','IN']);

        $chart6 = Charts::create('pie', 'fusioncharts')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->values([5,20,100,200])
            ->labels(['BR', 'ES', 'FR','IN']);

        $chart7 = Charts::create('donut', 'chartist')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->values([5,20,100,200])
            ->labels(['BR', 'ES', 'FR','IN']);

        $chart8 = Charts::create('donut', 'morris')
            ->title("Título do Gráfico - Bar")
            ->dimensions(0, 400) 
            ->colors(['#2196F3', '#F44336', '#FFC107'])
            ->values([5,20,100,200])
            ->labels(['BR', 'ES', 'FR','IN']);

        $chart9 = Charts::create('gauge', 'canvas-gauges')
        		    ->title('Título do Gráfico - Bar')
        		    ->elementLabel('Label')
        		    ->values([65,0,100])
        		    ->responsive(false)
        		    ->height(400)
        		    ->width(0)
        		    ->gaugeStyle('center');

        $chart10 = Charts::create('gauge', 'canvas-gauges')
		    ->title('Título do Gráfico - Bar')
		    ->elementLabel('Label')
		    ->values([65,0,100])
		    ->responsive(false)
		    ->height(400)
		    ->width(0);

		$chart11 = Charts::create('temp', 'canvas-gauges')
		    ->title('Título do Gráfico - Bar')
		    ->elementLabel('Label')
		    ->values([65,0,100])
		    ->responsive(false)
		    ->height(400)
		    ->width(0);

		$chart12 = Charts::create('percentage', 'justgage')
		    ->title('Título do Gráfico - Bar')
		    ->elementLabel('Label')
		    ->values([65,0,100])
		    ->responsive(false)
		    ->height(400)
		    ->width(0);

		$chart13 = Charts::database(Municipio::all(),'bar', 'material')
		    ->title('Título do Gráfico - Bar')
		    ->responsive(false)
		    ->height(400)
		    ->width(0)
		    ->groupBy('id_uf')
		    ->ElementLabel('Total de Municipio')
		    ->labels(['RO','AC','AM','RR','PA','AP','TO','MA','PI','CE','RN','PB','PE','AL','SE','BA','MG','ES','RJ','SP','PR','SC','RS','MS','MT','GO','DF']);

		$chart14 = Charts::realtime(route('data'),1000,'gauge', 'canvas-gauges')
		    ->title('Título do Gráfico - RealTime')
		    ->responsive(true)
		    ->height(400);

        return view(
        	'charts', 
        	[
        		'chart' 	=> $chart,
        		'chart2'	=> $chart2,
        		'chart3'	=> $chart3,
        		'chart4'	=> $chart4,
        		'chart5'	=> $chart5,
        		'chart6'	=> $chart6,
        		'chart7'	=> $chart7,
        		'chart8'	=> $chart8,
        		'chart9'	=> $chart9,
        		'chart10'	=> $chart10,
        		'chart11'	=> $chart11,
        		'chart12'	=> $chart12,
        		'chart13'	=> $chart13,
        		'chart14'	=> $chart14,
        	]

        );
    }
}
