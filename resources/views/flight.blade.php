<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>Flights</title>
    <style>
        body {
            overflow-x: hidden;
        }
        .btn-block {
            display: block;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand text-light" href="#">Flight</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            
            </ul> -->
        </div>
    </nav>
    <div class="row vh-100">
        <div class="col-md-3" style="background-color: #0f2e29;">
            <div class="container mt-4 mb-4">
                <div class="text-center">
                    <!-- <button class="btn btn-dark">On Way</button> -->
                    <!-- <button class="btn btn-dark">Return</button> -->
                    <input type="hidden" name="response" id="response">
                    <div class="btn-group">
                        <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked value="on_way"/>
                        <label class="btn btn-secondary" for="option1">On Way</label>
                        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="return"/>
                        <label class="btn btn-secondary" for="option2">Return</label>
                    </div>                
                </div>
                <div class="text-center mt-4">
                    <div class="mb-2">
                        <input type="text" name="origin" id="origin" placeholder="Enter Origin" class="form-control">
                        <span id="origin_error" class="text-danger"></span>
                    </div>
                    <div class="mb-2">
                        <input type="text" name="destination" id="destination" placeholder="Enter Destination" class="form-control">
                        <span id="destination_error" class="text-danger"></span>
                    </div>
                    <div class="mb-2">
                        <input type="date" name="date" id="date" class="form-control">
                        <span id="date_error" class="text-danger"></span>
                    </div>
                    <div class="mb-2">
                        <input type="number" min="1" max="10" name="passanger" id="passanger" class="form-control" placeholder="Enter Passanger">
                        <span id="number_error" class="text-danger"></span>
                    </div>
                    <div class="mb-2"><button class="btn btn-success" id="search">Search</button></div>
                </div>
            </div>
        </div>
        <div class="col-md-9" style="background-color: #ddd;">
            <div class="container mb-4 mt-4">            
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6" style="margin-top:9px;" id="origin_val">
                                <label>FROM <i class="fa fa-angle-double-right"></i> TO</label>
                            </div>
                            <div class="col-md-6" style="float:right" id="timing">
                                Depart : <label id="depart_time"></label><br>
                                Return : <label id="return"></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <hr>
            <div class="container mt-4 mb-4">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col"><button class="btn btn-primary btn-block" data-id="0" id="origin_sort">Origin <i class="fas fa-sort-amount-up"></i> </button></div>
                            <div class="col"><button class="btn btn-primary btn-block" data-id="0" id="destination_sort">Destination <i class="fas fa-sort-amount-up"></i> </button></div>
                            <div class="col"><button class="btn btn-primary btn-block" data-id="0" id="departure_sort">Departure <i class="fas fa-sort-amount-up"></i> </button></div>
                            <div class="col"><button class="btn btn-primary btn-block" data-id="0" id="arrival_sort">Arrival <i class="fas fa-sort-amount-up"></i> </button></div>
                            <div class="col"><button class="btn btn-primary btn-block" data-id="0" id="occupy_sort">Seats  <i class="fas fa-sort-amount-up"></i> </button></div>
                        </div>
                    </div>
                </div>
                <div id="detail"></div>                
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>

    var now = new Date();

    // Format the date as a string
    var dateString = now.toDateString();

    // Update the contents of the "date" element with the current date
    window.onload = function() {
        document.getElementById("return").innerHTML = dateString;
        document.getElementById("depart_time").innerHTML = dateString;
    };

        $(document).on('click','#search',function(){
            var error = 0;
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            var date = $('#date').val();
            var passanger = $('#passanger').val();
            var option = $('input[name="options"]:checked').val();    
            
            if(origin == ''){
                error = 1;
                $('#origin_error').html("Origin field is Required");
            }else {
                $('#origin_error').html("");
            }

            if(destination == ''){
                error = 1;
                $('#destination_error').html("Destination field is Required");
            }else {
                $('#destination_error').html("");
            }

            if(date == ''){
                error = 1;
                $('#date_error').html("Date field is Required");
            }else {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;

                if(today > date){
                    error = 1;
                    $('#date_error').html("The date should be future");
                } else {
                    // error = 0;
                    $('#date_error').html("");
                }
            }
            if(passanger == ''){
                error = 1;
                $('#number_error').html("Passanger field is Required");
            }else {
                if(passanger > 10){
                    error = 1;
                    $('#number_error').html("You only select 10 Pasanger");
                }else {
                    // error = 0;
                    $('#number_error').html("");
                }
            }
            if(error == 0){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('flight_search') }}",
                    type: 'post',
                    dataType: 'json',
                    data:{
                        "origin":origin,
                        "destination":destination,
                        "date":date,
                        "passanger":passanger,
                        "option":option,
                    },
                    success: function(response){                        
                        if(response != undefined){                        
                            $('#origin_val').html("<label> "+origin.toUpperCase()+ " <i class='fa fa-angle-double-right'></i> "+destination.toUpperCase()+"</label>");                            
                            $('#depart_time').html(date);
                            $('#return').html(date);
                            $('#response').val(JSON.stringify(response));
                            add_detail(response);
                        }
                    },
                    error: function(error){
                        console.log(error);
                    }
                });     
            }

        });

        function add_detail(response){
            if(response != undefined){
                $('#detail').html('');
                var res = '';
                $.each(response,function(key,value){
                    res += `
                        <div class="card mb-2">
                            <div class="card-header"> <h4>`+value.airline+`</h4> </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Rs. `+value.price+`</label><br>
                                        <label for=""> `+value.origin+` <i class='fa fa-angle-double-right'></i> `+value.destination+` </label><br>
                                        <label for="">Depart : `+value.departure+`</label><br>
                                        <label for="">Arrival : `+value.arrival+`</label>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Flight Number : `+value.airlineCode+`</label><br>
                                        <label for="">Duration : `+value.duration+`</label><br>
                                        <label for="">Flight Number : `+value.flightNumber+`</label><br>
                                        <label for="">Available Seats : `+value.availableSeats+`</label>
                                    </div>
                                    <div class="col-md-3">                                        
                                        <button class="btn btn-primary">Book This Flight</button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                });
                $('#detail').html(res);
            }
        }

        $(document).on('click','#origin_sort',function(){
            var response = $('#response').val();
            var id = $(this).attr('data-id');

            if(response != ''){
                response = JSON.parse(response);
                response.sort(SortByName)

                function SortByName(a, b){
                    var aName = a.origin.toLowerCase();
                    var bName = b.origin.toLowerCase();
                    if(id == 0){
                        $('#origin_sort').attr('data-id',1);
                        $('#origin_sort').html('Origin <i class="fas fa-sort-amount-up"></i>');
                        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                    }else {
                        $('#origin_sort').attr('data-id',0);
                        $('#origin_sort').html('Origin <i class="fas fa-sort-amount-down"></i>');
                        return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                    }
                }
                    
                add_detail(response);
            } else {
                alert('Please Give Some Input');
            }
        });

        $(document).on('click','#destination_sort',function(){
            var response = $('#response').val();
            var id = $(this).attr('data-id');

            if(response != ''){
                response = JSON.parse(response);
                response.sort(SortByName)
    
                function SortByName(a, b){
                    var aName = a.destination.toLowerCase();
                    var bName = b.destination.toLowerCase();
                    if(id == 0){
                        $('#destination_sort').attr('data-id',1);
                        $('#destination_sort').html('Destination <i class="fa fa-sort-amount-up"></i>');
                        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                    }else {
                        $('#destination_sort').attr('data-id',0);
                        $('#destination_sort').html('Destination <i class="fa fa-sort-amount-down"></i>');
                        return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                    }
                }
                add_detail(response);
            } else {
                alert('Please Give Some Input');
            }
        });

        $(document).on('click','#departure_sort',function(){
            var response = $('#response').val();
            var id = $(this).attr('data-id');

            if(response != ''){
                response = JSON.parse(response);
                response.sort(SortByName)
    
                function SortByName(a, b){
                    var aName = a.departure;//.toLowerCase();
                    var bName = b.departure;//.toLowerCase();
                    if(id == 0){
                        $('#departure_sort').attr('data-id',1)
                        $('#departure_sort').html('Departure <i class="fas fa-sort-amount-up"></i>')
                        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                    }else{
                        $('#departure_sort').attr('data-id',0)
                        $('#departure_sort').html('Departure <i class="fas fa-sort-amount-down"></i>')
                        return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                    }
                }
                add_detail(response);
            } else {
                alert('Please Give Some Input');
            }
        });

        $(document).on('click','#arrival_sort',function(){
            var response = $('#response').val();
            var id = $(this).attr('data-id');

            if(response != ''){
                response = JSON.parse(response);
                response.sort(SortByName)
    
                function SortByName(a, b){
                    var aName = a.arrival;//.toLowerCase();
                    var bName = b.arrival;//.toLowerCase();
                    if(id == 0){
                        $('#arrival_sort').attr('data-id',1)
                        $('#arrival_sort').html('Arrival <i class="fas fa-sort-amount-up"></i>')
                        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                    }else{
                        $('#arrival_sort').attr('data-id',0)
                        $('#arrival_sort').html('Arrival <i class="fas fa-sort-amount-down"></i>')
                        return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                    }
                }
                add_detail(response);
            } else {
                alert('Please Give Some Input');
            }
        });

        $(document).on('click','#occupy_sort',function(){
             var response = $('#response').val();
            var id = $(this).attr('data-id');

            if(response != ''){
                response = JSON.parse(response);
                response.sort(SortByName)

                function SortByName(a, b){
                    var aName = a.availableSeats;//.toLowerCase();
                    var bName = b.availableSeats;//.toLowerCase();
                    
                    if(id == 0){
                        $('#occupy_sort').attr('data-id',1);
                        $('#occupy_sort').html('Seats <i class="fas fa-sort-amount-up"></i>');
                        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                    }else {
                        $('#occupy_sort').attr('data-id',0);
                        $('#occupy_sort').html('Seats <i class="fas fa-sort-amount-down"></i>');
                        return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                    }
                }            
    
                add_detail(response);
            } else {
                alert('Please Give Some Input');
            }
        });


    </script>
</body>
</html>