<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 29.04.2020
 */

namespace App\Ticker;


use Illuminate\Support\Collection;

class TableTickerData extends TickerData
{

    /**
     * @inheritDoc
     */
    public function toRender(array $keys, array $data)
    {
        $collection = parent::toRender($keys, $data);
        return $collection->map(function ($item) {
            return collect($item)->only(['Date', 'Open', 'Hight', 'Low', 'Close', 'Volume']);
        })->all();
    }
}
