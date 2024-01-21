<?php

/**
 * This class used to check input date version, convert and return desired output 
 * 
**/

class EventDateConverter {
    const OLD_VERSION = '1.0.17+60';

    //convert event date
    public static function convertEventDate($eventDate, $currentVersion) {
        if (self::convertVersionIfGreater($currentVersion, self::OLD_VERSION)) {
            // External system changed timezone to UTC
            $eventDate = self::convertToUTC($eventDate);
        } else {
            // External system used Europe/Berlin timezone
            $eventDate = self::convertToEuropeBerlin($eventDate);
        }

        return $eventDate;
    }

    //check and compare versions
    private static function convertVersionIfGreater($currentVersion, $targetVersion) {
        // implement version comparison logic here
        $currentVersionParts = explode('.', $currentVersion);
        $targetVersionParts = explode('.', $targetVersion);

        for ($i = 0; $i < 3; $i++) {
            if ((int)$currentVersionParts[$i] > (int)$targetVersionParts[$i]) {
                return true;
            } elseif ((int)$currentVersionParts[$i] < (int)$targetVersionParts[$i]) {
                return false;
            }
        }

        return false; // return if versions are equal
    }

    //convert date to UTC
    private static function convertToUTC($eventDate) {
        // Implement logic to convert event date to UTC timezone
        $dateTime = new DateTime($eventDate, new DateTimeZone('Europe/Berlin'));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        return $dateTime->format('Y-m-d H:i:s');
    }

    //convert to Europe Berlin    
    private static function convertToEuropeBerlin($eventDate) {
        // implement logic to convert event date to Europe/Berlin timezone
        $dateTime = new DateTime($eventDate, new DateTimeZone('UTC'));
        $dateTime->setTimezone(new DateTimeZone('Europe/Berlin'));
        return $dateTime->format('Y-m-d H:i:s');
    }
}

//default input
$currentVersion = '1.1.3';
$eventDate = date("Y-m-d H:i:s");

//call convert event date
$convertedDate = EventDateConverter::convertEventDate($eventDate, $currentVersion);

echo "Original Event Date: $eventDate"."<hr />";
echo "Converted Event Date: $convertedDate";
?>