<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SellTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('user.checkout', [
            'order' => $request['order']
        ]);
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            Log::alert("START");

            //sleep(10);
            $order = Order::where('token', $request->input('token'))->first();

            $sell_ticket = SellTicket::where('id', $order->ticket_id)->first();

            if (($sell_ticket->quantity - $sell_ticket->sold) < $order->quantity) {
                Log::alert("FAIL");
                return response()->json([
                    'alert' => 'Số lượng vé không đủ'
                ], 422);
            }

            $sell_ticket = SellTicket::where('id', $order->ticket_id)->first();

            SellTicket::where('id', $order->ticket_id)->update([
                'sold' => ($order->quantity + $sell_ticket->sold)
            ]);
            Log::alert("SUCCESS");
            DB::commit(); // xác nhận hoàn thành

            session(['cost_id' => $request->id]);
            session(['url_prev' => url()->previous()]);
            $vnp_TmnCode = "WPO1MWEB"; //Mã website tại VNPAY 
            $vnp_HashSecret = "RNAZVLFQAAUGVHNNCCYJGRLZLLEUSTAK"; //Chuỗi bí mật
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:3000/user/result/checkout";
            $vnp_TxnRef = $request->input('token'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Nạp tiền";
            $vnp_OrderType = '250000';
            $vnp_Amount = $order->total * 100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            return response()->json([
                'url' => $vnp_Url
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();  // thực hiện lại
            return response()->json([],500);
        }
    }
}
