<?php
/**
 * Author: York
 * Email: yorkshp@gmail.com
 * Date: 29.04.2020
 */

namespace App\Ticker;


interface TickerDataInterface
{

    /**
     * @param array $keys
     * @param array $data
     * @return array|string
     */
    public function toRender(array $keys, array $data);

}
