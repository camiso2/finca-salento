<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\collection;
use Illuminate\Support\Arr;
use App\registerBedroom;
use App\RegisterOrder;
use App\RegisterCheckin;
use App\RegisterInvoice;
use DateTime;
use \PDF;
use phpDocumentor\Reflection\Types\Boolean;


class InvoiceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function invoicePDF(Request  $request)
    {
        try {
            //dat with elements relations all
            $data  =  $this->dataAllReceipt($request->debroom_id);
            //add disscount client
            $data = Arr::add($data, 'disscount', $request->disscountClient);

            //register values in invoice
            $registerBedroom = new RegisterInvoice;
            $registerBedroom->clientOutput = $this->fetchCurrent();
            $registerBedroom->dayStay = $data['dayStay'];
            $registerBedroom->hourStay = $data['hourStay'];
            $registerBedroom->disscountClient = $request->disscountClient;
            $registerBedroom->observations = $request->observations;
            $registerBedroom->numberInvoice = $data['numberInvoice'];
            $registerBedroom->valueStay = $data['valueStay'];
            $registerBedroom->total = $data['total'];
            $registerBedroom->iva = $data['iva'];
            $registerBedroom->subTotal = $data['subTotal'];
            $registerBedroom->state = null;
            $registerBedroom->delete = null;
            $registerBedroom->user_id = $request->user_id;
            $registerBedroom->debroom_id = $request->debroom_id;
            $registerBedroom->save();


            //dd("que pasa");
            //register  number  invoice por orders the client
            $orders = RegisterOrder::where('debroom_id', $request->debroom_id)->whereNull('numberInvoice')->orderBy('id', 'DESC')->get();
            if ($orders) {
                $this->registerNumberInvoiceOrders($request->debroom_id, $orders, $data['numberInvoice']);
            }


            //register  number  invoice client checkin
            $registerNumberInvoiceCheckin = RegisterCheckin::find($data['idCheckin']);
            $registerNumberInvoiceCheckin->numberInvoice = $data['numberInvoice'];
            $registerNumberInvoiceCheckin->save();

            //unoccupied room
            $unoccupied = registerBedroom::find($request->debroom_id);
            $unoccupied->occupation = null;
            $unoccupied->save();

            //create  pdf whith  invoive
            $pdf   = \PDF::loadView('dashboard.pdf_created.invoicePDF', $data);
            return $pdf->download();
        } catch (\Exception $e) {
            Log::info("Error generate Invoice:: " . $e->getMessage());
            return $e->getMessage();
        }
    }
    public function viewInvoice(Request $request)
    {
        try {
            $data  =  $this->dataAllReceipt($request->debroom_id);
            return response()->json($data);
        } catch (\Exception $e) {
            Log::info("Error Register Invoice:: " . $e->getMessage());
            return $e->getMessage();
        }
    }
    /**
     * Get all dat chekin client for receipt
     *
     * @param String $request
     * @param String $disscount
     * @return Array
     */

    private function dataAllReceipt(String $debroom_id): array
    {
        $checkin       = RegisterCheckin::where('debroom_id', $debroom_id)->whereNull('state')->orderBy('id', 'DESC')->first();
        $dayStay       = (int)$this->dayStay($checkin->created_at);
        $hourStay      = (int)$this->hourStay($checkin->created_at);
        $orders        = RegisterOrder::where('debroom_id', $debroom_id)->whereNull('numberInvoice')->orderBy('id', 'DESC')->get();
        $debroom       = registerBedroom::where('id', $debroom_id)->first();
        $subTotal      = (int) $this->totalOrders($orders) + (int) $this->valueStay($dayStay, $hourStay, $debroom->dayRoomCost);
        $iva           = (float)((env('IVA') / 100));
        $total         = (int) ($this->valueIva($subTotal, $iva) + $subTotal) - (int)$checkin->advance;
        $data = [
            'checkin'        => $checkin,
            'numberInvoice'  => $this->numberInvoice($checkin->id),
            'total'          => $total,
            'iva'            => $this->valueIva($subTotal, $iva),
            'subTotal'       => $subTotal,
            'bedroom'        => $debroom,
            'dayStay'        => $dayStay,
            'valueStay'      => $this->valueStay($dayStay, $hourStay, $debroom->dayRoomCost),
            'hourStay'       => $hourStay,
            'totalOrders'    => $this->totalOrders($orders),
            'orders'         => $orders,
            'success'        => 'success',
            'idCheckin'      => $checkin->id
        ];

        return $data;
    }

    /**
     * Get Number invoice this  order the client
     * @param collection $orders
     * @param String $debroomId
     * @param String $numberInvoice
     * @return Boolean
     */
    public function registerNumberInvoiceOrders(String $debroomId, $orders, String $numberInvoice): Bool
    {
        foreach ($orders as $order) {
            $registerNumberInvoiceOrders = RegisterOrder::find($order->id);
            $registerNumberInvoiceOrders->numberInvoice = $numberInvoice;
            $registerNumberInvoiceOrders->save();
        }
        return true;
    }

    /**
     * Get fetch hour current
     *
     * @return String
     */
    public function fetchCurrent(): String
    {

        $fetcCurrent = "";
        $current = new \DateTime();
        $fetcCurrent = $current->format('Y-m-d H:i:s') ;
        return $fetcCurrent;
    }

    /**
     * Get Number invoice client
     * @param String $id
     * @return String
     */
    public function numberInvoice(String $id): String
    {

        $numbeReceipt = "";
        $current = new \DateTime();
        $numbeReceipt = $current->format('YmdHis') . "-" . $id;
        return $numbeReceipt;
    }

    /**
     * Get hour value  iva
     *
     * @param Float $subtotal
     * @param Int $iva
     * @return Int
     */
    private function  valueIva(Int $subTotal, float $iva): Int
    {

        $TotalIva = 0;
        $TotalIva = $subTotal * $iva;
        return  $TotalIva;
    }
    /**
     * Get value days stay client
     *
     * @param int $dayStay
     * @param int $hourStay
     * @param int $dayRoomCost
     * @return Int
     */
    private function valueStay(int $dayStay, int $hourStay, int $dayRoomCost): Int
    {
        $costDay = 0;
        switch ($dayStay) {
            case 0:
                $costDay  = $dayRoomCost;
                break;
            default:
                if ($hourStay > 4) {
                    $costDay = ($dayStay + 1) * $dayRoomCost;
                } else {
                    $costDay = $dayStay * $dayRoomCost;
                }
                break;
        }
        return $costDay;
    }
    /**
     * Get quantity orders client
     *
     * @param collection $orders
     * @return String
     */
    private function totalOrders($orders): String
    {
        $totalOrders = 0;
        foreach ($orders as $order) {
            $totalOrders = $totalOrders + $order->valueOrder;
        }
        return $totalOrders;
    }
    /**
     * Get days Saty client
     *
     * @param string $entry
     * @return String
     */
    private function  dayStay(string $entry): String
    {
        //fecha actual del sistema
        $current = new \DateTime();
        $fetchCurrent = $current->format('Y-m-d H:i:s');
        //tiempo de estadía del huesped
        $actual_os = new DateTime($fetchCurrent);
        $fetchRegister = new DateTime($entry);
        $interval = $actual_os->diff($fetchRegister);
        $days =  (int) $interval->format('%R%a');
        return $days * (-1);
    }
    /**
     * Get hour Saty client
     *
     * @param string $entry
     * @return String
     */
    private function  hourStay(string $entry): String
    {
        //fecha actual del sistema
        $current = new \DateTime();
        $fetchCurrent = $current->format('Y-m-d H:i:s');
        //tiempo de estadía del huesped
        $actual_os = new DateTime($fetchCurrent);
        $fetchRegister = new DateTime($entry);
        $interval = $actual_os->diff($fetchRegister);
        $hours = (int) $interval->format('%H');
        return $hours;
    }
}
