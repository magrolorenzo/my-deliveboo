<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail; // Oggetto creato per invio mail al customer

use App\Restaurant;
use App\Order;
use App\OrderItem;
use App\Customer;

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
            $form_data = $request->all();

            // prendo dati cliente e li salvo nel DB
            $new_order = new Order();
            $new_order->fill($form_data);

            $new_order->save();

            // prendo l'id dell'ordine salvato
            $order_id = $new_order->id;

            // prendo i dati del carrello e li salvo nel DB
            $cart = json_decode($form_data['currentCart'], true);


            for ($i=0; $i < count($cart); $i++) {
                // creo nuovo oggetto
                $new_order_item = new OrderItem();

                // aggiunto e modifico i dati del singolo elemento
                $cart[$i]['order_id'] = $order_id;
                $cart[$i]['dish_id'] = $cart[$i]['id'];
                $cart[$i]['dish_name'] = $cart[$i]['name'];

                // compilo e salvo nel db
                $new_order_item->fill($cart[$i]);
                // dd($new_order_item);
                $new_order_item->save();
            }

            // Invio mail a customer
            $new_customer = new Customer();
            $new_customer->fill($form_data);
            $new_customer->order_id = $order_id;
            $new_customer->save();
            // Invio mail al customer
            // Passo come parametro al costruttore l oggetto intero $new_customer per recuparare i dati nel corpo della mail
            Mail::to($new_customer->customer_email)->send(new OrderMail($new_customer));

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
