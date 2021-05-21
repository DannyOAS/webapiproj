<?php $title = 'Transactions'; include("./components/top.php");?>
<div id="app">
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Payment Type</th>
        <th scope="col">Amount</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>

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
                axios.get('/api/transactions').then(function (response) {
                    console.log(response);
                })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    })
</script>
<?php include("./components/bottom.php");?>
