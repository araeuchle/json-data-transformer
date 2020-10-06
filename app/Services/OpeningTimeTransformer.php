<?php
namespace App\Services;

class OpeningTimeTransformer
{
    public function parseTimeString($timeString)
    {
        $timeStringParts = array_map('trim', explode(PHP_EOL, $timeString));
        $timeStringParts = array_map('App\Services\OpeningTimeTransformer::removeHolidayInformation', $timeStringParts);
        $timeStringParts = array_map('App\Services\OpeningTimeTransformer::transformTime', $timeStringParts);

        $outputString = '[';
        $counter = 1;
        $amount = count($timeStringParts);

        foreach ($timeStringParts as $stringPart) {
            $outputString .= '"' . $stringPart . '"';
            if ($counter < $amount) {
                $outputString .= ',';
            }
            $counter++;
        }
        $outputString .= ']';

        return $outputString;
    }

    private function removeHolidayInformation($string)
    {
        if (strpos($string, 'Closed') !== false) {
            return null;
        }

        if (mb_strlen($string) === 0) {
            return null;
        }

        $start  = strpos($string, '(');
        $end    = strpos($string, ')', $start + 1);
        if ($start !== false && $end !== false) {
            $length = $end - $start;
            return substr_replace($string,  '', $start, $length + 1 );
        }

        return $string;
    }

    private function transformTime($string)
    {
        if (strpos($string, 'Closed') !== false) {
            return null;
        }

        if (mb_strlen($string) === 0) {
            return null;
        }

        $newPartString = '';

        $parts = explode(' ', $string);
        $counter = 0;

        foreach ($parts as $part) {
            if (mb_strlen($part) === 0) {
                continue;
            }

            if ($counter === 0) {
                $newPartString = substr($part, 0, 2) . ' ';
            } else {
                $times = array_map('App\Services\OpeningTimeTransformer::transform', explode('–', $part));
                $newPartString .= implode('-', $times);
            }

            $counter++;
        }

        return $newPartString;
    }

    private function transform($time)
    {
        return date("H:i", strtotime($time));
    }

}
