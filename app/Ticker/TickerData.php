<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 29.04.2020
 */

namespace App\Ticker;


use Illuminate\Support\Collection;

abstract class TickerData implements TickerDataInterface
{

    /**
     * @param array $keys
     * @param array $data
     * @return array|Collection|string
     */
    public function toRender(array $keys, array $data)
    {
        return $this->comineKeysAndData($keys, $data);
    }

    /**
     * @param array $keys
     * @param array $data
     * @return Collection
     */
    private function comineKeysAndData(array $keys, array $data): Collection
    {
        $collectKeys = collect($keys);
        return collect($data)->map(static function ($item) use ($collectKeys) {
            return $collectKeys->combine($item)->toArray();
        });
    }

}
