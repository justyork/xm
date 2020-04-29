<?php

namespace Tests\Feature;

use App\Ticker\ChartTickerData;
use App\Ticker\TableTickerData;
use App\Ticker\Ticker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatasetTest extends TestCase
{

    /**
     * @var Ticker
     */
    private $ticker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ticker = (new Ticker('AAPL'))
            ->dateFrom('2012-12-21')
            ->dateTo('2012-12-22');

    }

    /** @test */
    public function dataset_loaded_with_correct_symbol(): void
    {
        $this->assertEquals($this->ticker->dataset()['dataset_code'], 'AAPL');
    }


    /** @test  Find first row with price 512.47 */
    public function table_data_is_correct(): void
    {
        $data = $this->ticker->render(new TableTickerData);
        $this->assertEquals('512.47', $data[0]['Open']);
    }

    /** @test  Find first row with price 512.47 */
    public function chart_data_is_availabel(): void
    {
        $data = $this->ticker->render(new ChartTickerData);
        $this->assertEquals('512.47', $data[0]['data'][0][1]);
    }

}
