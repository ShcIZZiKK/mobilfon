<?php

/*
 * РЕШЕНИЕ С ПОМОЩЬЮ ПРОСТОЙ ФУНКЦИИ
 * В данном варианте не знаю, как бороться с ошибкой,
 * если в функцию передается null,
 * поэтому обернул все в try catch
 * */

function highlight_nicknames(string $text): string
{
    $clear_text = trim($text);
    $result_text = '';

    if (empty($clear_text)) {
        throw new Error('Было передано пустое сообщение');
    }

    $ar_words = preg_split("/[\s]+/", $clear_text);

    foreach ($ar_words as $word) {
        if(
            strpos($word, '@') === 0 &&
            !is_numeric($word[1]) &&
            preg_match('/^[a-zA-Z0-9]+$/', mb_substr( $word, 1))
        ) {
            $result_text .= '<b>' . $word . '</b>';
        }
        else {
            $result_text .= $word;
        }
        $result_text .= ' ';
    }

    return substr($result_text,0,-1);
}

try {
    echo highlight_nicknames("@storm87 сообщил нам вчера о результатах\n
                                    Я живу в одном доме с @spartans и @300spartans\n
                                    Правильный ник: @usernick | неправильный ник: @usernick;");
}
catch (Error $e) {
    echo "<b>Получена ошибка: </b>", $e->getMessage(), "\n";
}


echo "<hr/>";


/* РЕШЕНИЕ С ПОМОЩЬЮ КЛАССА
 * Здесь текст передается при создании экземпляра класса
*/

class TextProcessing
{
    private $clear_text;
    private $ar_words = [];
    private $result_text = '';

    public function __construct($text = '')
    {
        try {
            $this->clear_text = $this->is_string($text);
        } catch (Exception $e) {
            echo "<b>Получена ошибка: </b>", $e->getMessage(), "\n";
        }
    }

    public function highlight_nicknames()
    {
        $this->ar_words = preg_split("/[\s]+/", $this->clear_text);

        foreach ($this->ar_words as $word) {
            $this->result_text .= $this->verification_word($word) . ' ';
        }

        return substr($this->result_text,0,-1);
    }

    private function is_string($text)
    {
        if (gettype($text) === 'string' && !empty(trim($text))) {
            return strip_tags(trim($text));
        }
        throw new Exception('Переданный параметр не является строкой или был пустым!');
    }

    private function verification_word($word)
    {
        $result_word = $word;

        if (
            strpos($word, '@') === 0 &&
            !is_numeric($word[1]) &&
            preg_match('/^[a-zA-Z0-9]+$/', mb_substr($word, 1))
        ) {
            $result_word = '<b>' . $word . '</b>';
        }

        return $result_word;
    }
}

$test = new TextProcessing("@storm87 сообщил нам вчера о результатах\n
Я живу в одном доме с @spartans и @300spartans\n
Правильный ник: @usernick | неправильный ник: @usernick;");

echo $test->highlight_nicknames();