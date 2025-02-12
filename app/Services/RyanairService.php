<?php

namespace App\Services;

use GuzzleHttp\Client;


class RyanairService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.ryanair.com/', // Base URI for Ryanair API
        ]);
    }

    public function getFlights($origin, $destination, $dateOut, $dateIn, $adults = 1, $children = 0, $infants = 0, $roundTrip = true)
    {
        try {
            $response = $this->client->request('GET', 'api/booking/v4/en-gb/availability', [
                'query' => [
                    'ADT' => $adults, // Number of adults
                    'CHD' => $children, // Number of children
                    'DateIn' => $dateIn, // Return date
                    'DateOut' => $dateOut, // Departure date
                    'Destination' => $destination, // Destination airport code
                    'Disc' => 0, // Discount code (optional)
                    'INF' => $infants, // Number of infants
                    'Origin' => $origin, // Origin airport code
                    'TEEN' => 0, // Number of teenagers
                    'promoCode' => '', // Promo code (optional)
                    'IncludeConnectingFlights' => 'false', // Include connecting flights
                    'FlexDaysBeforeOut' => 0, // Flexible days before outbound date
                    'FlexDaysOut' => 4, // Flexible days after outbound date
                    'FlexDaysBeforeIn' => 2, // Flexible days before inbound date
                    'FlexDaysIn' => 4, // Flexible days after inbound date
                    'RoundTrip' => $roundTrip ? 'True' : 'False', // Is it a round trip?
                    'ToUs' => 'AGREED', // Terms of use agreement
                ],
                'verify' => false,
                'headers' => [
                    'Cookie' => 'fr-correlation-id=8998d788-5a06-4ff9-814c-8ef2b7351481; rid=d1cc5016-7f85-4ae9-966a-f83e98941645; mkt=/gb/en/; STORAGE_PREFERENCES={"STRICTLY_NECESSARY":true,"PERFORMANCE":false,"FUNCTIONAL":false,"TARGETING":false,"SOCIAL_MEDIA":false,"PIXEL":false,"__VERSION":3}; RY_COOKIE_CONSENT=true; rid.sig=jyna6R42wntYgoTpqvxHMK7H+KyM6xLed+9I3KsvYZaVt7P36AL6zp9dGFPu5uVxaIiFpNXrszr+LfNCdY3IT3oCSYLeNv/ujtjsDqOzkY5JmUFsCdAEz3kpPbhCUwiArp5oaa75tpJtO3kFwYQ8l0DbH67AtcN/PMbniLsiM5qn+2AjrrtoNJicE3ZQwFHVipe4lWPSRfq2OIyUrlFhwEDt20+wCX7l1mCubNXtG6ly1DzBqZYVDrO1g5GvXPZOTmu2Dm7O3SDQqq5kadt432PNt4oORJDq14Y0jjNs3KWslQsH9ySI/yjUZU51mCYB8lZXVRPzV5FRZX942E/FLE2Iff6sURLZ3dXZLHNyClrJjn4UcA7R/2i+PROvvJy1LwXBQiSvKyOuWtpR+9svr2oUp6FHVtnNySspZozN0f+wSq9wWfQ/ahYt9B0MGkISfUMEIK2nIEky8flNwwhJ0CA4dOf6Hc0Qdvxfa6NYOOjaweUtzQ292uIsbaVf7qAblU+sy002A6hy5nMaVwyRUB0DJPBQsqE3gCeASLbajBn+JoSldNjFShdLcfNsbQrjCf462Y1yx8ewf7i7S6caF0CjfxkjfS9294CSyPP9jhP4TSQg2oKlCMJIGL8Np3zErk9Rd1wxjr+JVhUAK0KGVj/DjJxhztGxjBybxZJubRr2+VK7x4Uk7VWpAu93XCKTRXZQFHjNyEOHg2RcyFDkg8A8Y/Aok8EVS50iThnFaf/f+Ch+jSR6Fjwon+A7AQv8qsI34vzxo9/Y6UQzUKhzReNtOX1yjhzIen1rh4SxuLsRGAmq5FVlWXwNxbquqGqXryon5jw+Kj+XWAFeW8T1QdOlJJx50W3wU0gpvVawyEhzwNxu1X9P6Dsx2WF2BEOygBWM3R315lfSLjW2zwt38LQC3cQzphGDx2eb5hVZZQ4pkjMclLDONT0GGYJGQBAZ; .AspNetCore.Session=CfDJ8GwcxOOPTilKjb9iB3wfbcP2cpfEIL3WWex%2BI0CIFfngrziwe8OdNURgRbIQz1mp96B1a4MLAKizKrl2T3pSfBB3T274zUtneiMs8ZuMTHae7N8Yzq0A6dtHHteAukc%2B5ikcJUXtAWZidf2uUI8pnVmIgL3M80ghVc1c%2FcZFrgkE',
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}
