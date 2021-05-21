<html>
<head>

    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="styles/form.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>

<body class="text-center">

<div id="app" class="form-signin">
    <form>


        <h1 class="h3 mb-3 fw-normal">LOGIN</h1>

        <div class="form-floating">
            <input type="text" v-model="id" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Student ID</label>
        </div>
        <div class="form-floating">
            <input type="password" v-model="pin" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Pin</label>
        </div>


        <button v-on:click.prevent="getLoginToken" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

    </form>
</div>


</body>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            id: "",
            pin: ""
        },

        methods: {
            getLoginToken: function () {
                axios.post('/api/token', {
                    id: this.id,
                    pin: this.pin
                }).then(function (response) {
                    console.log(response);
                    localStorage.setItem("token", response.data['token'])
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