<?php
/**
 * Created by PhpStorm.
 * User: hyf84
 * Date: 2017/6/6
 * Time: 17:35
 */

namespace App\Transformers;

use App\Models\Test;
use League\Fractal\TransformerAbstract;

class TestTransformer extends TransformerAbstract
{
    public function transform(Test $test)
    {
        return [
            'area'=>$test['addr'],
        ];
    }
}