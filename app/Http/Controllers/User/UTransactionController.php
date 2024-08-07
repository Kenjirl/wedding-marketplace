<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WVBooking;
use App\Models\WVTransaction;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;

class UTransactionController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function transaksi(Request $req) {
        $id_booking = $req->input('id_booking');

        $booking = WVBooking::find($id_booking);
        if (!$booking) {
            return redirect()->back()->with('gagal', 'ID tidak valid');
        }

        $params = [
            'transaction_details' => [
                'order_id' => uniqid() . '_' . $booking->id,
                'gross_amount' => $booking->total_bayar,
            ],
            'item_details' => [
                [
                    "id" => $booking->plan->id,
                    "price" => $booking->plan->harga,
                    "quantity" => $booking->qty,
                    "name" => $booking->plan->nama
                ],
            ],
            'customer_details' => [
                'first_name' => auth()->user()->w_couple->nama,
                'last_name' => '',
                'email' => auth()->user()->email,
                'phone' => auth()->user()->w_couple->no_telp,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function notifikasi(Request $req) {
        $orderId = $req->query('order_id');
        $statusCode = $req->query('status_code');
        $transactionStatus = $req->query('transaction_status');

        if (!$orderId || !$statusCode || !$transactionStatus) {
            return response()->json(['message' => 'Invalid parameters'], 400);
        }

        list($order_id, $booking_id) = explode('_', $orderId);

        $booking = WVBooking::find($booking_id);
        if (!$booking) {
            return redirect()->route('user.pernikahan.index')->with('gagal', 'Terjadi kesalahan dalam menyelesaikan transaksi');
        }

        $transactionDetails = $this->getTransactionStatus($orderId);
        if (!$transactionDetails) {
            return redirect()->route('user.pernikahan.index')->with('gagal', 'Terjadi kesalahan dalam menyelesaikan transaksi');
        }

        // Log::info('Transaction details:', (array) $transactionDetails);

        if (in_array($transactionDetails['transaction_status'], ['capture', 'settlement'])) {
            $booking->status = 'dibayar';
            $booking->save();
        } else {
            $booking->status = 'diterima';
            $booking->save();
        }

        $data = $this->formatTransactionData($transactionDetails);

        $transaction = WVTransaction::where('order_id', $order_id)->first();
        if ($transaction) {
            $transaction->update($data);
        } else {
            $transaction = $booking->transaction()->create($data);
        }

        if (in_array($transactionDetails['transaction_status'], ['capture', 'settlement'])) {
            // SUKSES
            $transaction->transaction_status = $transactionDetails['transaction_status'];
            $transaction->save();

            $booking->status = 'dibayar';
            $booking->save();

            return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('sukses', 'Berhasil menyelesaikan transaksi');
        } elseif ($transactionDetails['status_code'] == '412') {
            // EXPIRE (FAILURE)
            $transaction->status_code = $transactionDetails['status_code'];
            $transaction->status_message = $transactionDetails['status_message'];
            $transaction->transaction_status = 'failure';
            $transaction->save();

            return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('gagal', 'Transaksi Anda sudah melewati batas tenggat waktu');
        } elseif ($transactionDetails['status_code'] == '407' || $transactionDetails['transaction_status'] == 'expire') {
            // EXPIRE
            $transaction->status_code = '407';
            $transaction->transaction_status = 'expire';
            $transaction->save();

            return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('gagal', 'Transaksi Anda sudah melewati batas tenggat waktu');
        } else {
            // PENDING
            return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('sukses', 'Transaksi berhasil dilakukan');
        }
    }

    protected function getTransactionStatus($order_id) {
        $client = new Client();
        $serverKey = Config::$serverKey;
        $baseUrl = Config::$isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/';

        try {
            $response = $client->request('GET', $baseUrl . $order_id . '/status', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':')
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }
        } catch (\Exception $e) {
            Log::error('Midtrans API request failed: ' . $e->getMessage());
        }

        return null;
    }

    protected function formatTransactionData(array $transactionDetails) {
        $data = $transactionDetails;

        if (isset($transactionDetails['bill_key']) && isset($transactionDetails['biller_code'])) {
            $data['bank'] = 'Mandiri';
            $data['va_number'] = $transactionDetails['bill_key'] . '-' . $transactionDetails['biller_code'];
        } else if ($transactionDetails['payment_type'] == 'credit_card' && isset($transactionDetails['bank'])) {
            $data['bank'] = strtoupper($transactionDetails['bank']);
        } else {
            if (isset($transactionDetails['va_numbers']) && is_array($transactionDetails['va_numbers']) && count($transactionDetails['va_numbers']) > 0) {
                $firstVaNumber = $transactionDetails['va_numbers'][0];

                $data['bank'] = isset($firstVaNumber['bank']) ? strtoupper($firstVaNumber['bank']) : null;
                $data['va_number'] = isset($firstVaNumber['va_number']) ? $firstVaNumber['va_number'] : null;
            } else {
                $data['bank'] = null;
                $data['va_number'] = null;
            }
        }

        return $data;
    }

    public function cek_status($id) {
        $client = new Client();
        $serverKey = Config::$serverKey;
        $baseUrl = Config::$isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/';

        try {
            $response = $client->request('GET', $baseUrl . $id . '/status', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':')
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $transactionDetails = json_decode($response->getBody()->getContents(), true);
                if (!$transactionDetails) {
                    return redirect()->route('user.pernikahan.index')->with('gagal', 'Terjadi kesalahan dari Midtrans dalam membatalkan transaksi');
                }

                Log::info('Transaction details:', (array) $transactionDetails);

                $transaction = WVTransaction::where('order_id', $id)->first();
                if (!$transaction) {
                    return redirect()->route('user.pernikahan.index')->with('gagal', 'Tidak ditemukan transaksi yang sesuai dalam membatalkan transaksi');
                }

                list($order_id, $booking_id) = explode('_', $id);
                $booking = WVBooking::find($booking_id);
                if (!$booking) {
                    return redirect()->route('user.pernikahan.index')->with('gagal', 'Tidak ditemukan pemesanan yang sesuai dalam membatalkan transaksi');
                }

                if (in_array($transactionDetails['transaction_status'], ['capture', 'settlement'])) {
                    // SUKSES
                    $transaction->transaction_status = $transactionDetails['transaction_status'];
                    $transaction->save();

                    $booking->status = 'dibayar';
                    $booking->save();

                    return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('sukses', 'Berhasil menyelesaikan transaksi');
                } elseif ($transactionDetails['status_code'] == '412') {
                    // EXPIRE (FAILURE)
                    $transaction->status_code = $transactionDetails['status_code'];
                    $transaction->status_message = $transactionDetails['status_message'];
                    $transaction->transaction_status = 'failure';
                    $transaction->save();

                    return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('gagal', 'Transaksi Anda sudah melewati batas tenggat waktu');
                } elseif ($transactionDetails['status_code'] == '407' || $transactionDetails['transaction_status'] == 'expire') {
                    // EXPIRE
                    $transaction->status_code = '407';
                    $transaction->transaction_status = 'expire';
                    $transaction->save();

                    return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('gagal', 'Transaksi Anda sudah melewati batas tenggat waktu');
                } else {
                    // STILL PENDING
                    return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('gagal', 'Transaksi masih belum diselesaikan');
                }
            }
        } catch (\Exception $e) {
            Log::error('Midtrans API request failed: ' . $e->getMessage());
        }

        return null;
    }

    public function batal($id) {
        $client = new Client();
        $serverKey = Config::$serverKey;
        $baseUrl = Config::$isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/';

        try {
            $response = $client->request('POST', $baseUrl . $id . '/cancel', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':')
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $transactionDetails = json_decode($response->getBody()->getContents(), true);
                if (!$transactionDetails) {
                    return redirect()->route('user.pernikahan.index')->with('gagal', 'Terjadi kesalahan dari Midtrans dalam membatalkan transaksi');
                }

                Log::info('Transaction details:', (array) $transactionDetails);

                $transaction = WVTransaction::where('order_id', $id)->first();
                if (!$transaction) {
                    return redirect()->route('user.pernikahan.index')->with('gagal', 'Tidak ditemukan transaksi yang sesuai dalam membatalkan transaksi');
                }

                list($order_id, $booking_id) = explode('_', $id);
                $booking = WVBooking::find($booking_id);
                if (!$booking) {
                    return redirect()->route('user.pernikahan.index')->with('gagal', 'Tidak ditemukan pemesanan yang sesuai dalam membatalkan transaksi');
                }

                if ($transactionDetails['status_code'] == '412') {
                    $transaction->status_code = $transactionDetails['status_code'];
                    $transaction->status_message = $transactionDetails['status_message'];
                    $transaction->transaction_status = 'failure';
                    $transaction->save();

                    return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('gagal', 'Transaksi Anda sudah melewati batas tenggat waktu');
                } else {
                    $transaction->transaction_status = $transactionDetails['transaction_status'];
                    $transaction->save();

                    return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('sukses', 'Transaksi dibatalkan');
                }
            }
        } catch (\Exception $e) {
            Log::error('Midtrans API request failed: ' . $e->getMessage());
        }

        return null;
    }

    public function daftar() {
        $user = auth()->user();
        $w_couple = $user->w_couple;

        $idWeddings = WCWedding::where('w_couple_id', $w_couple->id)->withTrashed()->pluck('id');
        $idBookings = WVBooking::whereIn('w_c_wedding_id', $idWeddings)->pluck('id');
        $transactions = WVTransaction::with(['booking.plan' => function ($query) {
                $query->withTrashed();
            }, 'booking.wedding' => function ($query) {
                $query->withTrashed();
            }])
            ->whereIn('w_v_booking_id', $idBookings)->get();

        return view('user.transaksi.index', compact('transactions'));
    }
}
