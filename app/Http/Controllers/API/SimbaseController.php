<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\SimBaseAuth;
use DateTime;

class SimbaseController extends Controller
{
    
    public function getAccommodationsData()
    {
        $data = (new SimBaseAuth)->callFunction('f_api_return_accommodations_data');
    	return response()->json($data);
    }

    public function saveAccommodationsData(Request $request)
    {
    	$data = (new simBaseAuth)->callFunction('f_api_save_accommodations_data', [
    		'acc_id'    => intval($request->accommodation),
    		'number'    => intval($request->number_of_rooms),
    		'room type' => intval($request->room_type),
    		'check in'  => $this->getDaysSinceUnix('2021-11-10', '1970-01-01'),
    		'nights'    => intval($request->nts),
    	]);
    	return response()->json($data);
    }

    private function getDaysSinceUnix( $fdate, $tdate)
    {
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval  = $datetime1->diff($datetime2);
        $days      = $interval->format('%a');
        return intval($days);
    }

}