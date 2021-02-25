const express = require('express');
const router = express.Router();
const braintree = require('braintree');

router.post('/', (req, res, next) => {
    const gateway = new braintree.BraintreeGateway({
        environment: braintree.Environment.Sandbox,
        // Use your own credentials from the sandbox Control Panel here
        merchantId: 't2dv6mqb3mg6srfn',
        publicKey: '7vt2npdjp4y9yz3y',
        privateKey: '0badb87ba2a6e965ebc7ce3443d701ef'
    });

    // Use the payment method nonce here
    const nonceFromTheClient = req.body.paymentMethodNonce;
    // Create a new transaction for $10
    const newTransaction = gateway.transaction.sale({
        amount: '10.00',
        paymentMethodNonce: nonceFromTheClient,
        options: {
            // This option requests the funds from the transaction
            // once it has been authorized successfully
            submitForSettlement: true
        }
    }, (error, result) => {
        if (result) {
            res.send(result);
        } else {
            res.status(500).send(error);
        }
    });
});

module.exports = router;
