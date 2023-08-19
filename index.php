<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Weather Data</title>
</head>
<body>
    <div class="container">
        <?php
        $json_data = file_get_contents('weather_data.json');
        $weather_data = json_decode($json_data, true);

        if ($weather_data) {
            echo '<h1 class="city-name">' . $weather_data['city']['name'] . ', ' . $weather_data['city']['country'] . '</h1>';
            echo '<div class="weather-table">';
            echo '<div class="table-row table-header">';
            echo '<div>Date & Time</div><div>Temperature (°C)</div><div>Weather</div><div>Wind (m/s)</div>';
            echo '</div>';

            foreach ($weather_data['list'] as $entry) {
                $date_time = date('Y-m-d H:i:s', $entry['dt']);
                $temperature = round($entry['main']['temp'] - 273.15, 2);
                $weather_description = $entry['weather'][0]['description'];
                $wind_speed = $entry['wind']['speed'];

                echo '<div class="table-row">';
                echo '<div>' . $date_time . '</div>';
                echo '<div>' . $temperature . '</div>';
                echo '<div>' . $weather_description . '</div>';
                echo '<div>' . $wind_speed . '</div>';
                echo '</div>';
            }

            echo '</div>';
        } else {
            echo '<p class="error-message">Error loading weather data.</p>';
        }
        ?>
    </div>
</body>
</html>
