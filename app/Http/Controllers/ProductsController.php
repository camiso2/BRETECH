<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;
use App;
use App\Producto;
use App\DetalleOrden;
use App\User;
use Carbon\Carbon;
use \PDF;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $products = Producto::whereNull('state', 'OR')->whereNull('deleted_at')->get();
            return response()->json(['list' => $products]);
        } catch (\Exception $e) {
            Log::info("Error list products enable Product:: " . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     *  Register data the product
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            ini_set('memory_limit', '256M');
            $file            = $request->file('fileImage');
            $destinationPath = "brewtech/";
            $product         = new Producto();
            $response        = $product->CreatedProduct($request, $destinationPath, $file);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::info("Error Register Product:: " . $e->getMessage());
            return $e->getMessage();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $product = Producto::where('id', $request->id)->first();
            if (is_null($product->state)) {
                Producto::where('id', $request->id)->update(['state' => Carbon::now()]);
            } else {
                Producto::where('id', $request->id)->update(['state' => null]);
            }
            return response()->json(['success' => $product->state]);
        } catch (\Exception $e) {
            Log::info("Error enable/desable Product:: " . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *

     * @param  String  $authenticate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Producto::where('id', $request->id)->update(['deleted_at' => Carbon::now()]);
            return response()->json($request->id);
        } catch (\Exception $e) {
            Log::info("Error destroy Product:: " . $e->getMessage());
            return $e->getMessage();
        }
    }

    /**
     * create data product
     *
     * @param Collection $request
     * @return Array
     */

    public function invoicePDF(Request $request)
    {
        try {
        $orderDetails = "";
        for ($x = 0; $x <= $request->inputs; $x++) {
            $orders        = array();
            $products      = [];
            $cantidad      = [];
            $valorUnitario = [];
            $iva = [];
            $valorTotal = [];
            for ($i = 0; $i <= $request->inputs; $i++) {
                $products[$i]      = $request->input('nombre_' . $i);
                $cantidad[$i]      = $request->input('cantidad_' . $i);
                $valorUnitario[$i] = $request->input('valorUnitario_' . $i);
                $iva[$i]           = $request->input('iva_' . $i);
                $valorTotal[$i] = $request->input('valorTotal_' . $i);
            }
            array_push($orders, ' producto : ' . $request->input('nombre_' . $x) . ', cantidad : ' . $request->input('cantidad_' . $x) . ', valorUnitario : ' . $request->input('valorUnitario_' . $x) . ', iva : ' . $request->input('iva_' . $x) . ', valorTotal : ' . $request->input('valorTotal_' . $x));
            foreach ($orders as $order) {
                $orderDetails .= $order . ",";
            }
        }
        $details = new DetalleOrden();
        $details->numeroFactura  = str_replace('No-', '', $request->numberInvoice);
        $details->cliente        = $request->cliente;
        $details->telefono       = $request->telefono;
        $details->email          = $request->email;
        $details->detallesOrden  = $orderDetails;
        $details->granSubtotal   = $request->granSubtotal;
        $details->granIva        = $request->granIva;
        $details->granTotal      = $request->granTotal;
        $details->user_id        = $request->user_id;
        $details->save();
        $user  = User::where('id', $request->user_id)->first();
        //create  pdf whith  invoive
        //----------------------------------------------------------------------
        $data = [
            'numberInvoice' => str_replace('No-', '', $request->numberInvoice),
            'user'          => $user,
            'cliente'       => $request->cliente,
            'email'         => $request->email,
            'telefono'      => $request->telefono,
            'granSubtotal'  => $request->granSubtotal,
            'granIva'       => $request->granIva,
            'granTotal'     => $request->granTotal,
            'products'      => $products,
            'cantidad'      => $cantidad,
            'valorUnitario' => $valorUnitario,
            'iva'           => $iva,
            'valorTotal'    => $valorTotal,
        ];
        $pdf   = \PDF::loadView('pdf_created.invoicePDF', $data);
        //return $pdf->stream();
        return $pdf->download();
    } catch (\Exception $e) {
        Log::info("Error created invoice PDF:: " . $e->getMessage());
        return $e->getMessage();
    }

    }



}
