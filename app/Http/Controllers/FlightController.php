<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function flight()
    {
        return view('flight');
    }
    public function flight_search(Request $request)
    {
        $origin = strtoupper($request->origin);
        $destination = strtoupper($request->destination);
        $date = $request->date;
        $passanger = $request->passanger;
        $option = $request->option;

        $dayOfWeek = date('N', strtotime($date));
    
        $response = '[{
              "airline": "Jet Airways",
              "airlineCode": "9W",
              "flightNumber": 186,
              "origin": "PNQ",
              "availableSeats": 116,
              "destination": "DEL",
              "price": 6733,
              "departure": "2013-01-01T10:59:00.000Z",
              "arrival": "2013-01-01T13:32:00.000Z",
              "duration": "2h 33m",
              "operationalDays": [
                0,
                2
              ]
            },{
              "airline": "Jet Airways",
              "airlineCode": "9W",
              "flightNumber": 251,
              "origin": "PNQ",
              "availableSeats": 53,
              "destination": "DEL",
              "price": 8713,
              "departure": "2013-01-01T08:17:00.000Z",
              "arrival": "2013-01-01T10:54:00.000Z",
              "duration": "2h 37m",
              "operationalDays": [
                7
              ]
            },{
              "airline": "Indigo",
              "airlineCode": "6E",
              "flightNumber": 224,
              "origin": "PNQ",
              "availableSeats": 87,
              "destination": "DEL",
              "price": 5996,
              "departure": "2013-01-01T03:09:00.000Z",
              "arrival": "2013-01-01T05:25:00.000Z",
              "duration": "2h 16m",
              "operationalDays": [
                7
              ]
            },{
              "airline": "Air India",
              "airlineCode": "AI",
              "flightNumber": 192,
              "origin": "PNQ",
              "availableSeats": 28,
              "destination": "DEL",
              "price": 3652,
              "departure": "2013-01-01T09:30:00.000Z",
              "arrival": "2013-01-01T11:31:00.000Z",
              "duration": "2h 1m",
              "operationalDays": [
                7
              ]
            },{
              "airline": "Spice Jet",
              "airlineCode": "SG",
              "flightNumber": 241,
              "origin": "PNQ",
              "availableSeats": 29,
              "destination": "DEL",
              "price": 7413,
              "departure": "2013-01-01T13:55:00.000Z",
              "arrival": "2013-01-01T15:43:00.000Z",
              "duration": "1h 48m",
              "operationalDays": [
                7
              ]
            },{
              "airline": "Indigo",
              "airlineCode": "6E",
              "flightNumber": 240,
              "origin": "PNQ",
              "availableSeats": 10,
              "destination": "DEL",
              "price": 4843,
              "departure": "2013-01-01T05:47:00.000Z",
              "arrival": "2013-01-01T07:35:00.000Z",
              "duration": "1h 48m",
              "operationalDays": [
                7
              ]
            },{
              "airline": "Air India",
              "airlineCode": "AI",
              "flightNumber": 167,
              "origin": "PNQ",
              "availableSeats": 126,
              "destination": "DEL",
              "price": 2930,
              "departure": "2013-01-01T12:10:00.000Z",
              "arrival": "2013-01-01T14:00:00.000Z",
              "duration": "1h 50m",
              "operationalDays": [
                1,
                2
              ]
            },{
              "airline": "Spice Jet",
              "airlineCode": "SG",
              "flightNumber": 254,
              "origin": "PNQ",
              "availableSeats": 33,
              "destination": "DEL",
              "price": 4191,
              "departure": "2013-01-01T10:01:00.000Z",
              "arrival": "2013-01-01T12:35:00.000Z",
              "duration": "2h 34m",
              "operationalDays": [
                7
              ]
            },{
              "airline": "Jet Airways",
              "airlineCode": "9W",
              "flightNumber": 144,
              "origin": "PNQ",
              "availableSeats": 45,
              "destination": "DEL",
              "price": 5788,
              "departure": "2013-01-01T06:09:00.000Z",
              "arrival": "2013-01-01T09:06:00.000Z",
              "duration": "2h 57m",
              "operationalDays": [
                3,
                4
              ]
            },{
              "airline": "Air India",
              "airlineCode": "AI",
              "flightNumber": 193,
              "origin": "PNQ",
              "availableSeats": 71,
              "destination": "DEL",
              "price": 7460,
              "departure": "2013-01-01T11:03:00.000Z",
              "arrival": "2013-01-01T12:57:00.000Z",
              "duration": "1h 54m",
              "operationalDays": [
                6,
                5
              ]
            }]';
        
        $result = json_decode($response,true);

        // Loop through the array and check if each row matches the search criteria
        $results = array();
        foreach ($result as $row) {
            if ($row['origin'] == $origin && $row['destination'] == $destination && in_array($dayOfWeek, $row['operationalDays'])) {
                $results[] = $row;
            }
        }
        print_r(json_encode($results));
    }
}
