<?php	// UTF-8 marker äöüÄÖÜß€
require_once './Page.php';

class Scrambler extends Page
{
    // to do: declare reference variables for members
    // representing substructures/blocks
     private $userInputText;

    protected function __construct()
    {
        parent::__construct();
    }

    protected function __destruct()
    {
        parent::__destruct();
    }

    protected function mb_str_shuffle($str) {
        $tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
        shuffle($tmp);
        return join("", $tmp);
    }

    protected function scramble($text)
    {
        $wordsInText = explode(" ",$text);
        foreach ($wordsInText as &$word) {
            $word =
                mb_substr($word, 0, 1)
                .$this->mb_str_shuffle(mb_substr($word, 1, strlen($word)-2))
            .mb_substr($word, strlen($word)-1, 1);

            var_dump($word);
        }
        return implode(" ",$wordsInText);
    }

    protected function generateView()
    {
        $output = $this->scramble($this->userInputText);
        $this->generatePageHeader('Scramble text');
        echo<<<EOT
<form action="Task2.php" method="post">
    Input Text: <br>
    <textarea name="userInputText" rows="30" cols="50">$this->userInputText</textarea><br>
    <button type="submit">Scramble!</button>
</form>

<h1>Output</h1>
<p>
EOT;
        echo<<<EOT
$output

</p>

EOT;

        $this->generatePageFooter();
    }

    protected function processReceivedData()
    {
        parent::processReceivedData();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->userInputText  = $this->test_input($_POST["userInputText"]);
        }
    }

    protected function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function main()
    {
        try {
            $page = new Scrambler();
            $page->processReceivedData();
            $page->generateView();
        }
        catch (Exception $e) {
            header("Content-type: text/plain; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

Scrambler::main();
