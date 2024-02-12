<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
class HajiraController extends Controller
{
    //
    public function fetchInsert(Request $request){
   
   /*     $response=Http::get('https://ethiohajj.com/api/pilgrim/22PXFUQQ',[
         'headers' => [
                'X-Authorization' => 'GViwAFO9tyNVSEhxH5wp43n3BF1f8O4EWzHa5up3KqqzipyrAwpU5F3SYffO851n',
                'X-Authorization-Secret' => '4ygkMzQb4udXYcpGinCRfYaGK846SWsduGoPGRIY928IUUgySWbjED012qw21hsY',
            ],
    ]);
    //return view('post.new',['hajira'=>$response]);*/


    $client = new Client();
    try {
        $response = $client->get('https://ethiohajj.com/api/pilgrim/'. $request->payment_code, [
            'headers' => [
                'X-Authorization' => 'GViwAFO9tyNVSEhxH5wp43n3BF1f8O4EWzHa5up3KqqzipyrAwpU5F3SYffO851n',
                'X-Authorization-Secret' => '4ygkMzQb4udXYcpGinCRfYaGK846SWsduGoPGRIY928IUUgySWbjED012qw21hsY',
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $data = $response->getBody()->getContents();

        // Process the response data as needed


        $arrayData = json_decode($data, true);

        return view('post.new',['data'=>$arrayData]);

        
        
        //return $arrayData['success'];
  
    } catch (ClientException $e) {
        if ($e->getResponse()->getStatusCode() === 404) {
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
            $arrayData = $errorResponse;

            return view('post.new',['data'=>$arrayData]);
        } else {
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents(), true);
            $arrayData = $errorResponse;
            return view('post.new',['data'=>$arrayData]);
        }
    } catch (GuzzleException $e) {
        return "something is wrong";
    }
    
}
}
