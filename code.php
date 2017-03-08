<?php

function balanceBrackets($str)
{
    $brackets = [
        '{' => '}',
        '[' => ']',
        '(' => ')'
    ];

    preg_match_all('/[(){}\[\]]/', $str, $matches);


    return sortBracketArray($matches[0], $brackets);
}

function sortBracketArray($ary, $brackets)
{
    if (!is_array($ary)) return false;

    if (count($ary) == 0) return true;

    if (count($ary) == 1) return false;

    $openBracket = $ary[0];

    if (!isset($brackets[$openBracket])) return false;

    $closeBracketIndex = getCloseBracket($openBracket, $brackets[$openBracket], $ary);

    $leftBracketArray = array_slice($ary, 1, $closeBracketIndex - 1);
    $rightBracketArray = array_slice($ary, $closeBracketIndex + 1);

    if (sortBracketArray($leftBracketArray, $brackets) && sortBracketArray($rightBracketArray, $brackets)) {
        return 'YES';
    } else {
        return 'NO';
    }
}

function getCloseBracket($openBracket, $closeBracket, $ary)
{
    $openBracketCount = 0;
    $closeBracketIndex = 0;

    for ($i = 1, $n = count($ary); $i < $n; $i++) {
        if ($ary[$i] == $closeBracketIndex && $openBracketCount == 0) {
            $closeBracketIndex = $i;
            break;
        }

        if ($ary[$i] == $openBracket) $openBracketCount++;
        if ($ary[$i] == $closeBracket) $openBracketCount--;
    }

    return $closeBracketIndex;
}

// Examples:

//$testStr = '{[}]';
//$testStr = '{}[]{}';
$testStr = '{{[()]}}{}';

$result = balanceBrackets($testStr);
echo $result;
