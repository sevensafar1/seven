<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Payment;


class PaymentController extends Controller
{
    //
    public function payment_success(Request $request)
{
    $input = $request->all();

    // Initialize the Razorpay API
    $api = new Api(env('RAZORPAY_KEY'), env('RAZOR_SECRET'));
    \Log::info('Razorpay API initialized with keys.');

    if (isset($input['razorpay_payment_id'])) {
        try {
            // Fetch the payment from Razorpay
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            \Log::info('Fetched payment details: ' . json_encode($payment));

            // Ensure the amount is correct before capturing
            $expectedAmount = $payment['amount']; // The amount from Razorpay in paise
            if ($expectedAmount <= 0) {
                throw new Exception('Invalid payment amount.');
            }

            // Capture the payment (amount is already fetched from the form)
            $response = $payment->capture(['amount' => $expectedAmount]);
            \Log::info('Razorpay Payment Captured: ' . json_encode($response));

            // Prepare payment data
            $paymentData = [
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'amount' => $expectedAmount / 100, // Convert paise back to INR for saving
                'name' => $input['name'],
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'pin_code' => $input['pin_code'],
                'country' => $input['country'],
                'pay_for' => $input['payment_for'],
                'remark' => $input['package_detail'],
                'payment_status' => 'success',
            ];

            // Save payment to database
            Payment::create($paymentData);
            \Log::info('Payment saved to database: ' . json_encode($paymentData));

            // Set confirmation message and redirect
            Session::put('confirmMsg', 'Payment successful');
            return redirect()->route('payment'); // Redirect to the relevant page

        } catch (\Exception $e) {
            // Log the exact error message and stack trace for debugging
            \Log::error('Razorpay Payment Capture Error: ' . $e->getMessage() . ' ' . $e->getTraceAsString());

            // Set error message and redirect to the payment page
            Session::put('errMsg', 'Payment failed. ' . $e->getMessage());
            return redirect()->route('payment');
        }
    } else {
        // Log missing Razorpay payment ID error
        \Log::error('Razorpay Payment ID missing from request: ' . json_encode($input));

        // Set error message and redirect
        Session::put('errMsg', 'Payment failed. Payment ID not found.');
        return redirect()->route('payment');
    }
}

}
