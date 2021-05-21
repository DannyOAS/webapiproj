<?php $title = 'Transactions'; include("./components/top.php");?>
<div id="app">
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Payment Type</th>
        <th scope="col">Fee Type</th>
        <th scope="col">Reference</th>
        <th scope="col">Amount</th>
    </tr>
    <tr v-for="(trans,index) in transactions">
        <td>{{index + 1}}</td>
        <td>{{ trans.fee_type }}</td>
        <td>{{ trans.payment_type }}</td>
        <td>{{ trans.reference_no }}</td>
        <td><b>GHS </b> {{ trans.amount }}</td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>




</div>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            transactions:[]
        },
        mounted(){
            this.loadTransaction();
        },

        methods: {
            loadTransaction: function () {
                const self = this;
                axios.get('/api/transactions', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem("token")
                    }
                }).then(function (response) {
                    console.log(response);
                    self.transactions = response.data.data;
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    })
</script>
<?php include("./components/bottom.php");?>
