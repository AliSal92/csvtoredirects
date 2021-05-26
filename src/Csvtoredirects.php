<?php


namespace AliSal;


use ParseCsv\Csv;

class Csvtoredirects
{
    /**
     * @var Csv
     */
    public Csv $csv;

    public string $file = '';        // the csv file location

    protected bool $_loaded = false;        // the csv is loaded

    /**
     * class constructor
     *
     * @param string $csvFile the csv file
     *
     * @return Csvtoredirects
     */
    public function __construct(string $csvFile)
    {
        $this->file = $csvFile;
        $this->csv = new Csv();
        return $this;
    }

    /**
     * load the CSV file and start the redirects
     *
     * @param string|null $match the url to match in the csv defaults to current page url
     *
     * @return bool true on redirect false on no redirect
     */
    public function start(string $match = ''): bool
    {
        if(!$this->_loaded){
            $this->load();
        }

        if(!$match){
            $match = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }

        foreach ($this->csv->data as $row) {
            if ($this->match($row['from'], $match, $row['operator'])) {
                return $this->_redirect($row['to'], $row['type']);
            }
        }
        return false;
    }

    /**
     * load the CSV file
     */
    public function load():void
    {
        $this->csv->auto($this->file);
        $this->_loaded = true;
    }

    /**
     * Check match with redirect condition
     *
     * @param string $needle the from url
     * @param string $heystack the url that we are matching
     * @param string $operator the operator used to match
     *
     * @return bool true if match happens
     */
    protected function match(string $needle, string $heystack, string $operator): bool
    {
        if ($operator == '=') {
            if ($needle == $heystack) {
                return true;
            }
        }
        if ($operator == 'contains') {
            if (strpos($heystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * PHP redirect
     * @param $to string the target url
     * @param $type int the type of the redirect 301,302 etc..
     */
    protected function _redirect(string $to, int $type): bool
    {
        header("Location: " . $to, true, $type);
        return true;
    }
}