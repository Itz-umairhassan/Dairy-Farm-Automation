<?php
class Helper
{
    // a helper function to parse query strings....
    public function parser($str)
    {
        if (empty($str))
            return [];
        $arr = explode('&', $str);

        $result = [];
        foreach ($arr as $pair) {
            $pp = explode('=', $pair);
            $result[$pp[0]] = $pp[1];
        }

        return $result;
    }

}

?>

