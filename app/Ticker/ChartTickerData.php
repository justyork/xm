<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 29.04.2020
 */

namespace App\Ticker;


use Illuminate\Support\Collection;

class ChartTickerData extends TickerData
{

    /**
     * @inheritDoc
     */
    public function toRender(array $keys, array $data)
    {
        $collection = parent::toRender($keys, $data);

        $open = $this->collectionToDataset($collection, 'Open');
        $close = $this->collectionToDataset($collection, 'Close');

        return [
            $open,
            $close
        ];
    }

    /**
     * @param Collection $collection
     * @param string $field
     * @return array
     */
    private function collectionToDataset(Collection $collection, string $field): array
    {
        // take date and field. Sorting date asc
        $data = $collection->map(function ($item) use ($field) {
            return [
                strtotime($item['Date']) * 1000, // to javascript time
                $item[$field],
            ];
        })->sortBy(0)->values()->toArray();

        return [
            'name' => $field,
            'data' => $data
        ];
    }
}
