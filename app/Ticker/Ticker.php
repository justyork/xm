<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 28.04.2020
 */

namespace App\Ticker;


use App\Url;

class Ticker
{
    private $ticker;
    private $dateFrom;
    private $dateTo;
    private $dataset;
    private $tickerUrl = 'https://www.quandl.com/api/v3/datasets/WIKI/';
    private $outputFormat = 'json';


    public function __construct(?string $ticker = null)
    {
        $this->ticker = $ticker;
    }

    /**
     * @param string $date
     * @return Ticker
     */
    public function dateFrom(?string $date): Ticker
    {
        $this->dateFrom = $date;
        return $this;
    }

    /**
     * @param string $date
     * @return Ticker
     */
    public function dateTo(?string $date): Ticker
    {
        $this->dateTo = $date;
        return  $this;
    }

    /**
     * @param TickerDataInterface $tickerData
     * @return array|string
     */
    public function render(TickerDataInterface $tickerData)
    {
        return $tickerData->toRender($this->dataset()['column_names'], $this->dataset()['data']);
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'ticker' => $this->ticker,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo
        ];
    }

    /**
     * @return array
     */
    public function dataset(): array
    {
        if (!$this->dataset) {
            $endpoint = $this->tickerUrl . $this->ticker . '.' . $this->outputFormat;

            $this->dataset = (new Url($endpoint))
                ->params([
                    'api_key' => env('QUANDL_API_KEY'),
                    'start_date' => $this->dateFrom ?? null,
                    'end_date' => $this->dateTo ?? null
                ])
                ->getArray();
        }

        return $this->dataset['dataset'] ?? [];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->dataset()['name'] ?? null;
    }


}
