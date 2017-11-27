<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;
use Validator;
use PDF;
use Mail;
use App\Model\InvoiceTemplate;
use App\Model\InvoiceReminderTemplate;
use App\Model\InvoiceMail;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = Invoice::groupBy('institute_id')->paginate(30);
        return view('invoice.index',['invoice'=>$invoice]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.show',['invoice'=>$invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $institute = $invoice->institute->institute_name;
        $view = view('invoice.edit',['invoice'=>$invoice]);
        return response()->json(['success'=>$view->render(),'institute'=>$institute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'amount' => 'required|numeric',
            'consultancyPercentage' => 'numeric',
            'gst' => 'numeric',
            'fromDate' => 'required|date',
            'toDate' => 'required|date'
        ])->validate();

        $invoice = Invoice::findOrFail($id);
        $invoice->amount = $request->input('amount',0.00);
        $invoice->consult_percentage = $request->input('consultancyPercentage',0.00);
        $invoice->gst = $request->input('gst',0.00);
        $invoice->from_date = date('Y-m-d',strtotime($request->input('fromDate',date('d-m-Y'))));
        $invoice->to_date = date('Y-m-d',strtotime($request->input('toDate',date('d-m-Y'))));
        $subtotal = $invoice->sub_total ?$invoice->sub_total : 0.00;
        $grandTotal = $invoice->grand_total ?$invoice->grand_total : 0.00;

        if(floatval($invoice->consult_percentage) > 0){
            $pe = $invoice->consult_percentage / 100;
            $subtotal = $invoice->amount*$pe;
            $grandTotal = $subtotal;
            if(floatval($invoice->gst) >0){
                $g_pe = floatval($invoice->gst) /100;
                $grandTotal = $grandTotal + ($g_pe*$grandTotal);
            }
        }
        $invoice->sub_total = $subtotal;
        $invoice->grand_total = $grandTotal;
        $invoice->save();
        $request->session()->flash('success', 'Created was successful!');
        return response()->json(['success'=>'success']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDownload($id){
        $invoice = Invoice::findOrFail($id);
        $template = InvoiceTemplate::first();
        $pdf = PDF::loadView('invoice.download',['invoice'=>$invoice,'template'=>$template]);
        return $pdf->download('download.pdf');
    }
    public function getsend($id){
        $user_id = \Auth::user()->id;
        $invoice = Invoice::findOrFail($id);
        $template = InvoiceTemplate::first();
        $date = date('d-m-Y H:i');
        $render = view('emails.invoicemail',['invoice'=>$invoice,'template'=>$template]);
        $res = Mail::send('emails.invoicemail',['invoice'=>$invoice,'template'=>$template],function($msg) use($invoice,$date){
            $msg->subject('Invoice - '.$date);
            $msg->to($invoice->institute->email_id);
        });
        $sent = new InvoiceMail;
        $sent->updated_by = $user_id;
        $sent->invoice_id = $id;
        $sent->mail_body = $render->render();
        $sent->subject = 'Invoice - '.$date;
        $sent->save();
        return response()->json(['success'=>'success']);
    }
}
