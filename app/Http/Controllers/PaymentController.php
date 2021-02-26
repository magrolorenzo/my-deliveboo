<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class PaymentController extends Controller
{

    public function checkout(Request $request){

        // Creo oggetto gateway
        $gateway = new \Braintree\Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY')
        ]);

        // Genero token
        $token = $gateway->ClientToken()->generate();


        $id = $request->input("id");
        $restaurant = Restaurant::find($id);

        if(!$restaurant){
            abort(404);
        };

        $data = [
            'restaurant' => $restaurant,
            "gateway" => $gateway,
            "token" => $token
        ];

        return view("guest.checkout-prova", $data);
    }


    public function pay_and_order(Request $request){

        // dd($request->input());

        $gateway = new \Braintree\Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY')
        ]);


        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // Se pagamento positivo
        if ($result->success || !is_null($result->transaction)) {
            $transaction = $result->transaction;

            // Qui salvataggio dati tabella ordini ??


            return redirect()->route('home')->with("success_message", "Grazie di aver effettuato un ordine con noi!");
            // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);


        } else {
            dd($result);
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: " . $baseUrl . "index.php");

            return back();
        }
    }
}
