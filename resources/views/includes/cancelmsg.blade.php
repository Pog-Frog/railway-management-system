<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    body {
        background-size: cover;
        height: 100%;
        font-size: large;
        background: "{{ URL::asset('pics/user/railway.jpg') }}" no-repeat center center fixed;
        background-size: cover;
    }

   .tm-bg-black {
    background-color: rgba(0, 0, 0, 0.5);

}

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }


</style>

<body>

        <div class="container">
		    <form>

            <div class="card border-0 shadow my-5">
                <div class="card-body p-5">
                    <h2 class="tm-block-title d-inline-block"> Ticket Cancelled Successfuly.</h2>
                    <br />
                    <br />
                    <br />
                    <br />
                    <a href="{{route('user_index')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Return to homepage</a>
                </div>
            </div>
       </form>


    </div>


</body>

</html>
