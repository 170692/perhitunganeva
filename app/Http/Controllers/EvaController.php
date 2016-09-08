<?php

namespace App\Http\Controllers;

use App\Models\Hitungeva;
use App\Models\Inputproject;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EvaController extends Controller {
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function debug(Request $request) {

        $filename   = 'saved_xml.xml';

        $filexml    = $request->file('xml');
        $parser = new Parser();
        $parser->xml($filexml);


        // $filexml->move(public_path(), $filename);
        // $temp       = file_get_contents($url);
        //$xml        = simplexml_load_file('public/'.$filename) or die("Error: Cannot create object");

        $n = $xml->Name;
        $bcws = $xml->Tasks->Task->BCWS;
        $bcwp = $xml->Tasks->Task->BCWP;
        $acwp = $xml->Tasks->Task->ACWP;
        $cost = $xml->Tasks->Task->Baseline->Cost;
        $duration = $xml->Tasks->Task->Baseline->Duration;

        $name = substr($n, 0, strpos($n, ".xml"));
        $bac = substr($cost, 0, -2);
        $pac = substr($duration, 2, strpos($duration, "H")-2);

        $date = date('y-m-j');
        $pv = substr($bcws, 0, strpos($bcws, "00.00"));
        $ev = substr($bcwp, 0, strpos($bcwp, "00.00"));
        $ac = substr($acwp, 0, strpos($acwp, "00.00"));
        $cv = $ev - $ac;
        $sv = $ev - $pv;
        $cpi = $ev/$ac;
        $spi = $ev/$pv;
        $tac = $pac/$spi;
        $dac = $pac - $tac;
        $tcpi = ($bac - $ev)/($bac - $ac);
        $eac = $bac/$cpi;
        $etc = $eac - $ac;
        $vac = $bac - $eac;

        // echo $date;
        // echo $cpi;
        // echo "\n";
        // echo $spi;
        // echo $pac;
        // echo $bac;
        // echo $tac;
        // echo $dac;
        // echo $tcpi;
        // echo $eac;
        // echo $etc;
        // echo $vac;
        // echo $pv;
        // echo $ev;
        // echo $ac;


        // var_dump(Hitungeva::All());
        Hitungeva::create(array(
          'evaluate_at'     => $date,
          'planned_value'   => $pv,
          'earned_value'    => $ev,
          'actual_cost'     => $ac,
          'schedule_variance'   => $sv,
          'cost_variance'   => $cv,
          'CPI'   => $cpi,
          'SPI'   => $spi,
          'time_at_completion'  => $tac,
          'delay_at_completion'   => $dac,
          'TCPI'  => $tcpi,
          'EAC'   => $eac,
          'ETC'   => $etc,
          'VAC'   => $vac,
        ));

        Inputproject::create(array(
          'name'    => $name,
          'budget_at_completion' => $bac,
          'plan_at_completion' => $pac,
        ));


    }

    public function index(Request $request) {
        $returnData         = array();
        $response           = "OK";
        $statusCode         = 200;
        $result             = null;
        $message            = "Mengambil semua data untuk tanggal ".date('y-m-j')." sukses.";
        $isError            = FALSE;
        $missingParams      = null;

        $input              = $request->all();
        $date               = (isset($input['date']))   ? $input['date']    : date('y-m-j');
        $name               = (isset($input['name']))   ? $input['name']    : null;

        if (!$isError) {
            try {
                if (isset($name)) {
                    $result     = Hitungeva::where('name', $name)->get();
                } else {
                    $result     = Hitungeva::where('evaluate_at', $date)->get();
                }

            } catch (\Exception $e) {
                $response   = "FAILED";
                $statusCode = 400;
                $message    = $e->getMessage()." on line: " . $e->getLine();
            }
        }

        $returnData = array(
            'response'      => $response,
            'status_code'   => $statusCode,
            'message'       => $message,
            'result'        => $result
        );

        return  response()->json($returnData, $statusCode)->header('access-control-allow-origin', '*');
    }

    public function uploadXML(Request $request) {
        $returnData         = array();
        $response           = "OK";
        $statusCode         = 200;
        $result             = null;
        $message            = "Mengubah data dari xml ke dalam bentuk array sukses.";
        $isError            = FALSE;
        $missingParams      = null;

        $input              = $request->all();
        $files              = ($request->hasFile('files')) ? $request->file('files') : null;

        if (!isset($files)) { $missingParams[] = "files"; }

        if (isset($missingParams)) {
            $isError    = TRUE;
            $response   = "FAILED";
            $statusCode = 400;
            $message    = "Missing parameters : {".implode(', ', $missingParams)."}";
        }

        if (!$isError) {
            try {
                foreach ($files as $key => $value) {
                    if ($value->getClientOriginalExtension() == 'xml') {
                        $xml = simplexml_load_file($value);

                        $n = $xml->Name;
                        $bcws = $xml->Tasks->Task->BCWS;
                        $bcwp = $xml->Tasks->Task->BCWP;
                        $acwp = $xml->Tasks->Task->ACWP;
                        $cost = $xml->Tasks->Task->Baseline->Cost;
                        $duration = $xml->Tasks->Task->Baseline->Duration;

                        $name = substr($n, 0, strpos($n, ".xml"));
                        $bac = substr($cost, 0, -2);
                        $pac = substr($duration, 2, strpos($duration, "H")-2);

                        $date = date('y-m-j');
                        $pv = substr($bcws, 0, strpos($bcws, "00.00"));
                        $ev = substr($bcwp, 0, strpos($bcwp, "00.00"));
                        $ac = substr($acwp, 0, strpos($acwp, "00.00"));
                        $cv = $ev - $ac;
                        $sv = $ev - $pv;
                        $cpi = $ev/$ac;
                        $spi = $ev/$pv;
                        $tac = $pac/$spi;
                        $dac = $pac - $tac;
                        $tcpi = ($bac - $ev)/($bac - $ac);
                        $eac = $bac/$cpi;
                        $etc = $eac - $ac;
                        $vac = $bac - $eac;

                        // var_dump($n);

                        Hitungeva::create(array(
                            'CPI'                   => $cpi,
                            'SPI'                   => $spi,
                            'EAC'                   => $eac,
                            'ETC'                   => $etc,
                            'VAC'                   => $vac,
                            'name'                  => $name,
                            'TCPI'                  => $tcpi,
                            'evaluate_at'           => $date,
                            'actual_cost'           => $ac,
                            'earned_value'          => $ev,
                            'planned_value'         => $pv,
                            'cost_variance'         => $cv,
                            'schedule_variance'     => $sv,
                            'time_at_completion'    => $tac,
                            'plan_at_completion'    => $pac,
                            'delay_at_completion'   => $dac,
                            'budget_at_completion'  => $bac,
                        ));
                    }
                }
            } catch (\Exception $e) {
                $response   = "FAILED";
                $statusCode = 400;
                $message    = $e->getMessage()." on line: " . $e->getLine();
            }
        }

        $returnData = array(
            'response'      => $response,
            'status_code'   => $statusCode,
            'message'       => $message,
            'result'        => $result
        );

        return  response()->json($returnData, $statusCode)->header('access-control-allow-origin', '*');
    }

    public function get(Request $request){
        $date   = date('y-m-j');
        $dataev = Hitungeva::where('evaluate_at', $date)->first();

        $datelist   = Hitungeva::select('evaluate_at');
        $project    = Inputproject::select('name', 'budget_at_completion', 'plan_at_completion')->get();

        $graphic    = Hitungeva::select('evaluate_at', 'planned_value', 'earned_value', 'actual_cost')->get();

        $result = array(
            'data' => $dataev,
            'datelist' => $datelist,
            'projectlist'=> $project,
            'graphic' => $graphic,
        );

        return response()->json($result, 200)->header('access-control-allow-origin', '*');
    }

}
