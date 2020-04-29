<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 28.04.2020
 */

namespace App\Ticker;


use App\Url;
use GuzzleHttp\Client;

class Ticker
{
    private ?string $ticker;
    private ?string $dateFrom;
    private ?string $dateTo;
    private $data;
    private string $tickerUrl = 'https://www.quandl.com/api/v3/datasets/WIKI/';
    private string $outputFormat = 'json';


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
     * @param array $data
     */
    public function fill(array $data): void
    {
        $this->ticker ??= $data['ticker'];
        $this->dateFrom ??= $data['date_from'];
        $this->dateTo ??= $data['date_to'];
    }

    /**
     * @param $name
     * @return string
     */
    public function getData($name): ?string
    {
        return $this->{$name} ?? null;
    }

    /**
     * @param TickerDataInterface $tickerData
     * @return array|string
     */
    public function render(TickerDataInterface $tickerData)
    {
        return $tickerData->toRender($this->data()['column_names'], $this->data()['data']);
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
    public function data(): array
    {
        if (!$this->data) {
            $endpoint = $this->tickerUrl . $this->ticker . '.' . $this->outputFormat;

            $this->data = (new Url($endpoint))
                ->params([
                    'api_key' => env('QUANDL_API_KEY'),
                    'start_date' => $this->dateFrom ?? null,
                    'end_date' => $this->dateTo ?? null
                ])
                ->getArray();
        }

        return $this->data['dataset'];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->data()['name'];
    }


}
