<!doctype html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Make a payment</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            background: #f5f5f5
        }

        .rounded {
            border-radius: 1rem
        }

        .nav-pills .nav-link {
            color: #555
        }

        .nav-pills .nav-link.active {
            color: white
        }

        input[type="radio"] {
            margin-right: 5px
        }

        .bold {
            font-weight: bold
        }</style>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript'
            src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

</head>
<body>
<div class="container py-5" id="app">

    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6">Make a payment</h1>
        </div>
    </div> <!-- End -->
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">

                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li @click="changePaymentType(0)" class="nav-item"><a data-toggle="pill" href="#credit-card" class="nav-link active "> <i
                                            class="fas fa-credit-card mr-2"></i> Credit Card </a></li>
                            <li @click="changePaymentType(1)" class="nav-item"><a data-toggle="pill" href="#net-banking" class="nav-link "> <i
                                            class="fas fa-mobile-alt mr-2"></i> Mobile Money</a></li>
                        </ul>
                    </div> <!-- End -->
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <div class="form-group "><label for="Fee type">
                                <h6>Fee Type</h6>
                            </label> <select v-model="feeType" class="form-control" id="ccmonth">
                                <option value="" selected disabled>---</option>
                                <option>Academic Fees</option>
                                <option>Residential Fees</option>
                                <option>Other</option>
                            </select></div>
                        <div class="form-group"><label for="username">
                                <h6>Amount</h6></label>
                            <input v-model="amount" type="number" name="username" placeholder="Amount GHS" required
                                   class="form-control ">
                        </div>


                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" onsubmit="event.preventDefault()">
                                <div class="form-group"><label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required
                                                    class="form-control "></div>
                                <div class="form-group"><label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"><input type="text" name="cardNumber"
                                                                    placeholder="Valid card number"
                                                                    class="form-control " required>
                                        <div class="input-group-append"><span class="input-group-text text-muted"> <i
                                                        class="fab fa-cc-visa mx-1"></i> <i
                                                        class="fab fa-cc-mastercard mx-1"></i> <i
                                                        class="fab fa-cc-amex mx-1"></i> </span></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"><label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"><input type="number" placeholder="MM" name=""
                                                                            class="form-control" required> <input
                                                        type="number" placeholder="YY" name="" class="form-control"
                                                        required></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"><label data-toggle="tooltip"
                                                                            title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button @click="makePayment" type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm
                                        Payment
                                    </button>
                            </form>
                        </div>
                    </div> <!-- End -->

                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group "><label for="Select Your Bank">
                                <h6>Pay with Mobile Money</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Network--</option>
                                <option>MTN</option>
                                <option>Vodafone</option>
                                <option>AirtelTigo</option>
                            </select></div>
                        </label> <input type="text" name="username" placeholder="Number"
                                        required class="form-control ">
                        <br>

                        <div class="form-group">
                            <p>
                                <button @click="makePayment" type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i>
                                    Proceed Payment
                                </button>
                            </p>
                        </div>
                        <p class="text-muted">Test Payment </p>
                    </div> <!-- End -->
                    <!-- End -->


                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            referenceNumber: 'TK' + Date.now(),
            amount: 0,
            feeType: "",
            paymentType: ""
        },

        mounted() {

        },

        methods: {
            changePaymentType: function (index) {
                if(index == 0)
                    this.paymentType = "CARD"
                else
                    this.paymentType = "MOBILE_MONEY";

            },
            makePayment: function () {
                axios.post('/api/make-payment', {
                    reference_no: this.referenceNumber,
                    fee_type: this.feeType,
                    payment_type: this.paymentType,
                    amount: this.amount,
                }, {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem("token")
                        }
                    }
                ).then(function (response) {
                    console.log(response);

                    window.location.replace('/transactions.php')
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    })
</script>
</html>
