<?php

/**
 * 某一键名的值不能重复，删除重复项
 * @param  array  $arr 数组
 * @param  string  $key 需要排除的 key
 * @return array
 */
function assoc_unique(array $arr, string $key): array
{
    $tmp_arr = array();
    foreach ($arr as $k => $v) {
        if (in_array($v[$key], $tmp_arr)) {// 搜索$v[$key]是否在$tmp_arr数组中存在，若存在返回true
            unset($arr[$k]);
        } else {
            $tmp_arr[] = $v[$key];
        }
    }
    sort($arr); // sort函数对数组进行排序
    return $arr;
}

/**
 * 比较参数
 * @param  array  $originalParam 原始参数
 * @param  array  $currentParam 当前传入的参数
 * @return array
 */
function compareParams(array $originalParam, array $currentParam): array
{
    return [
        'addData'    => array_values(array_diff($currentParam, $originalParam)),
        'deleteData' => array_values(array_diff($originalParam, $currentParam)),
        'keepData'   => array_values(array_intersect($originalParam, $currentParam)),
    ];
}

// 获取二维数组的前N个
function getSlicedArray($array, $n = 3, $key = ''): array
{
    // 倒序
    if ($key) {
        array_multisort(array_column($array, $key), SORT_DESC, $array);
    }

    return array_values(array_slice($array, 0, $n, true));
}
