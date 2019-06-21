<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ApiBlizzardGuildController extends Controller
{

    function getBlizzardRoster(Request $request) {
        $client_secret = env('BLIZZARD_API_CLIENT_SECRET','');
        $client_id = env('BLIZZARD_API_CLIENT_ID', '');
        $params = array('grant_type' => 'client_credentials');



        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://eu.battle.net/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode($client_id.':'.$client_secret),
                'Content-Type: application/x-www-form-urlencoded',
                'Cache-control: no-cache'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $access_token = json_decode($response)->access_token;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://eu.api.blizzard.com/wow/guild/Ysondre/The%20Fallen?fields=members&access_token='.$access_token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Cache-control: no-cache'
            ),
        ));

        $json = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!empty($json)) {
            $json = json_decode($json, true);
        } else {
            // get from database
        }

        foreach ($json['members'] as $key => $member) {
            if (($this->getRank($member['rank']) == false) or (preg_match('/(\d)/', $member['character']['name']))) {
                unset($json['members'][$key]);
            }
        }

        return $json;

        // return $json;
    }

    private function getRank(int $rank) {
        $allowedRanks = array(
            0 => 'Guild Master',
            1 => 'Officer',
            3 => 'Veteran',
            4 => 'Novice',
            5 => 'Apply');

        if (array_key_exists($rank, $allowedRanks)) { return $allowedRanks[$rank]; }
        else { return false; }
    }


}
