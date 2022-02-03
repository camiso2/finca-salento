<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\collection;

use App\registerBedroom;
use App\RegisterOrder;
use App\RegisterCheckin;
use App\RegisterInvoice;
use DateTime;
use \PDF;

class ReportController extends Controller
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
    public function reportDayPDF(Request  $request)
    {
        try {


            switch ($request->typeReport) {
                case '1':
                    $initDate         = new DateTime($request->fetchIni);
                    $debrooms         = registerBedroom::orderBy('id', 'DESC')->get();
                    $orders           = RegisterOrder::whereDate('created_at', $initDate )->orderBy('id', 'DESC')->get();
                    $checkins         = RegisterCheckin::whereDate('created_at', $initDate )->orderBy('id', 'DESC')->get();
                    $invoices         = RegisterInvoice::whereDate('created_at', $initDate )->orderBy('id', 'DESC')->get();
                    $availableRooms   = registerBedroom::whereNull('occupation')->count();
                    $totalSales       = $this->totalSales($orders);
                    $totalIva         = $this->totalIva($invoices);
                    $totalDisscounts  = $this->totalDisscounts($invoices);
                    $totalStaySales   = $this->totalStaySales($invoices);

                    $data = ['debrooms' => $debrooms, 'orders' => $orders, 'checkins' => $checkins, 'invoices' => $invoices, 'availableRooms' => $availableRooms, 'totalSales' => $totalSales, 'totalIva' => $totalIva, 'totalDisscounts' => $totalDisscounts, 'totalStaySales' => $totalStaySales];
                    $pdf   = \PDF::loadView('dashboard.pdf_created.reportDayPDF', $data);
                    return $pdf->stream();
                    break;

                case '2':
                    $initDate         = new DateTime($request->initDate);
                    $finalDate        = new DateTime($request->finalDate);
                    $debrooms         = registerBedroom::orderBy('id', 'DESC')->get();
                    $orders           = RegisterOrder::whereBetween('created_at', [$initDate, $finalDate])->orderBy('id', 'DESC')->get();
                    $checkins         = RegisterCheckin::whereBetween('created_at', [$initDate, $finalDate])->orderBy('id', 'DESC')->get();
                    $invoices         = RegisterInvoice::whereBetween('created_at', [$initDate, $finalDate])->orderBy('id', 'DESC')->get();
                    $availableRooms   = registerBedroom::whereNull('occupation')->count();
                    $totalSales       = $this->totalSales($orders);
                    $totalIva         = $this->totalIva($invoices);
                    $totalDisscounts  = $this->totalDisscounts($invoices);
                    $totalStaySales   = $this->totalStaySales($invoices);

                    $data = ['debrooms' => $debrooms, 'orders' => $orders, 'checkins' => $checkins, 'invoices' => $invoices, 'availableRooms' => $availableRooms, 'totalSales' => $totalSales, 'totalIva' => $totalIva, 'totalDisscounts' => $totalDisscounts, 'totalStaySales' => $totalStaySales];
                    $pdf   = \PDF::loadView('dashboard.pdf_created.reportDayPDF', $data);
                    return $pdf->stream();
                    break;
                    break;
                default:
                    return response()->json(['error' => 'error']);
                    break;
            }
        } catch (\Exception $e) {
            Log::info("Error List report:: " . $e->getMessage());
            return $e->getMessage();
        }
    }
    /**
     * Get Number invoice this  order the client
     * @param collection $invoices
     * @return Int
     */
    private function totalStaySales($invoices): int
    {
        $totalStaySales  = 0;
        foreach ($invoices as $invoice) {
            $totalStaySales  =  $totalStaySales + ((int) $invoice->subTotal);
        }
        return $totalStaySales;
    }

    /**
     * Get Number invoice this  order the client
     * @param collection $invoices
     * @return Int
     */
    private function totalDisscounts($invoices): int
    {
        $totalDisscounts  = 0;
        foreach ($invoices as $invoice) {
            $totalDisscounts  =  $totalDisscounts + (int) $invoice->disscountClient;
        }
        return $totalDisscounts;
    }

    /**
     * Get Number invoice this  order the client
     * @param collection $invoices
     * @return Int
     */
    private function totalIva($invoices): int
    {
        $totalIva  = 0;
        foreach ($invoices as $invoice) {
            $totalIva  =  $totalIva + (int) $invoice->iva;
        }
        return $totalIva;
    }

    /**
     * Get Number invoice this  order the client
     * @param collection $orders
     * @return Int
     */
    private function totalSales($orders): int
    {
        $totalSales  = 0;
        foreach ($orders as $order) {
            $totalSales  =  $totalSales + (int) $order->valueOrder;
        }
        return $totalSales;
    }
}
