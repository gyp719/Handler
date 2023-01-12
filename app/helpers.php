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

/**
 * 将字符按照指定长度截取为多个
 * @param $str
 * @param  int  $groupSize 每组的字符数量
 * @param  string  $encoding 字符串的字符编码
 * @return array
 */
function getSlicedStrArray($str, int $groupSize = 8000, string $encoding = 'UTF-8'): array
{
    // 计算字符串中的字符数
    $numChars = mb_strlen($str, $encoding);

    $strArray = [];
    // 循环处理字符串
    for ($i = 0; $i < $numChars; $i += $groupSize) {
        // 截断字符串
        $strArray[] = mb_substr($str, $i, $groupSize, $encoding);;
    }

    return $strArray;
}


/**
 * 对富文本信息中的数据
 * 匹配出所有的 <img> 标签的 src属性
 * @param  string  $contentStr  富文本字符串
 * @return array
 */
function getPatternMatchImages(string $contentStr = ""): array
{
    $imgSrcArr = array();
    //首先将富文本字符串中的 img 标签进行匹配
    $pattern_imgTag = '/<img\b.*?(?:\>|\/>)/i';
    preg_match_all($pattern_imgTag, $contentStr, $matchIMG);
    if (isset($matchIMG[0])) {
        foreach ($matchIMG[0] as $key => $imgTag) {
            //进一步提取 img标签中的 src属性信息
            $pattern_src = '/\bsrc\b\s*=\s*[\'\"]?([^\'\"]*)[\'\"]?/i';
            preg_match_all($pattern_src, $imgTag, $matchSrc);
            if (isset($matchSrc[1])) {
                foreach ($matchSrc[1] as $src) {
                    //将匹配到的src信息压入数组
                    $imgSrcArr[] = $src;
                }
            }
        }
    }
    return $imgSrcArr;
}


/**
 * 获取多维数组某个特定键的所有值
 * @param  string  $key 要查找的 key
 * @param  array  $array 在其中查找的数组。
 * @param string $default 如果 key 不存在，则返回的默认值。
 * @return mixed|null
 */
function getArrKeyValue(string $key, array $array, string $default = '')
{
    if (isset($array[$key])) {
        return $array[$key];
    }
    foreach ($array as $value) {
        if (is_object($value)) {
            $value = (array)$value;
        }
        if (is_array($value)) {
            $result = getArrKeyValue($key, $value, $default);
            if ($result !== $default) {
                return $result;
            }
        }
    }

    return $default;
}
