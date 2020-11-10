<?php
$result = revertCharacters("Привет! Давно не виделись.");
echo $result; // Тевирп! Онвад ен ьсиледив.
/**
 * @param $text
 * @return string
 */
function revertCharacters($text)
{
    $getWords = explode(' ', $text);
    foreach ($getWords as $keyWord => $word) {
        $currentWord = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
        $arraySign = [];
        $arrayLetter = [];
        foreach ($currentWord as $key => $value) {
            if (preg_match('%^\p{Lu}%u', $value)) {
                $arrayLetter = [$key];
            }
            if (preg_replace("|[^~!@#$%^&*()\\,.?;:<>'\"\`=_+-\/\\\\]+|i", "", $value)) {
                $arraySign[$key] = $value;
            }
        }
        $revertWord = mb_strtolower(utf8_strrev($word));
        $newWord = preg_replace('/[^ a-zа-яё\d]/ui', '', $revertWord);
        $splitNewWord = preg_split('//u', $newWord, -1, PREG_SPLIT_NO_EMPTY);
        if (count($arraySign) > 0) {
            foreach ($arraySign as $k => $v) {
                $endOfWord = array_slice($splitNewWord, $k);
                $splitNewWord = array_slice($splitNewWord, 0, $k);
                $splitNewWord[$k] = $v;
                $splitNewWord = array_merge($splitNewWord, $endOfWord);
            }
            unset($arraySign);
        }
        if (count($arrayLetter) > 0) {
            foreach ($arrayLetter as $k => $v) {
                $splitNewWord[$v] = mb_strtoupper($splitNewWord[$v]);
            }
            unset($arrayLetter);
        }
        $finalWord = implode("", $splitNewWord);
        $arrString[] = $finalWord;
    }
    $finalString = implode(" ", $arrString);
    return $finalString;
}

/**
 * @param $str
 * @return string
 */
function utf8_strrev($str)
{
    preg_match_all('/./us', $str, $ar);
    return join('', array_reverse($ar[0]));
}
