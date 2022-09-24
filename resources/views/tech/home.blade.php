<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Technician tasks</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <style>
        body {
            background: url('bck.jpg') ;
            background-size: cover;
        }

        img {
            width: 100px;
        }
        .tm-bg-black {
    background-color: rgba(0, 0, 0, 0.5);
}
        .tm-logout-icon {
               font-size: 1.5em;
                        }

        #sublink {
            font-size: 16px;
            padding: 6px 12px;
            background-color: #28a745;
            border-color: #28a745;
        }

        #sublink:hover {
            background-color: #006400;
        }

        .customer {
            width: 200px;
        }

        .slidecontainer {
            width: 100%;
        }

        .slider {
            -webkit-appearance:none;
            width: 200px;
            height: 20px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 15px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }
        .center {
  margin: 0;
  position: absolute;
  top: 95%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

    </style>

</head>

<body>
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-xl navbar-light bg-light">
                <a class="navbar-brand brand-logo mr-5">&nbsp;</a>
                <a>
                    <h1 class="navbar-brand mb-0">Welcome</h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="">
                                Active Reports
                            </a>
                        </li>


                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex" href="{{route('logout_tech')}}">
                                <i class="far fa-user mr-2 tm-logout-icon"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">
        <form>
        
            <div class=" card border-0 shadow my-5">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col">
                            
                            <h2 class="tm-block-title d-inline-block">Hello, Technician </h2>
                            <br />
                       
                        </div>
                        <div class="col-md-auto">
                            <img src={{ URL::asset('pics/tech/profile.png') }} alt="Avatar image" class="img-thumbnail" />
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mt-3 text-center">
                            <thead>
                            
                                <tr class="tm-bg-gray" >
                                    <th></th>
                                    <th scope="col" class="text-center">Report No#</th>
                                    <th scope="col">Captain Name</th>
                                    <th scope="col">Train Number</th>
                                    <th scope="col">Date Time</th>
                                    <th></th>
                                    <th scope="col" class="text-center">status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach( $report as $row)
                                    <td ></td>
                                    <td class="text-center">{{$row->id}}</td>
                                    <td class="Tasks"> {{$row->captains->name}}</td>
                                    <td class="Tasks">{{$row->trains->train_no}}</td>
                                    <td class="text-center"> {{$row->date}}</td>
                                   
                                    <td class="open-report"><i class="fas fa-paperclip"></i></td>
                                    <td class="text-center">
                                        @if($row->status == 'false')
                                        read
                                        @else
                                        unread
                                        @endif
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="text-center">
                                        <form method="POST" action="{{['report_id'=>($row['id'])]}}">
                                        @csrf
                                        <div class="col text-center">
                                          
                                            <button class="btn btn-success" type="submit">Open</button>
                                           
                                        </div>
                                        </form>
                                    </td>
                                </div>
                            </div>
                         </tr>
                         </td>

                                </tr>
                                @endforeach

                            

                            </tbody>
                        </table>
                     
            </div>
           
        </form>
       
    </div>
    <script>
        $(function () {
            $('.open-report').on('click', function () {
                window.location.href = '{{ URL::asset('pics/tech/report.pdf')}}';
            });
        })
    </script>

</body>
</html>