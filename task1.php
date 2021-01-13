<?php

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
            echo 'Получена ошибка: ', $e->getMessage(), "\n";
        }
    }

    public function highlight_nicknames()
    {
        $this->ar_words = preg_split("/[\s]+/", $this->clear_text);

        foreach ($this->ar_words as $word) {
            $this->result_text .= $this->verification_word($word) . ' ';
        }

        return $this->result_text;
    }

    private function is_string($text)
    {
        if (gettype($text) === 'string' && !empty(trim($text))) {
            return strip_tags(trim($text));
        }
        throw new Exception('Переданный параметр не является строкой или был пустым!');
    }

    private function verification_word($word) {
        $result_word = $word;

        if(
            strpos($word, '@') === 0 &&
            !is_numeric($word[1]) &&
            preg_match('/^[a-zA-Z0-9]+$/', mb_substr( $word, 1))
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
