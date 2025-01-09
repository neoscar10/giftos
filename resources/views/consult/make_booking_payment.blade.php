<!DOCTYPE html>
<html>

<head>
    @include('consult.css')
    @include('home.css')
</head>

<body>
    
    <div class="container" style="width: 500px">
        <div class="header">
            <h1>Time Slot Reserved</h1>
            <p>Make Payment within 2hrs or reservation will be revoked</p>
        </div>

        <div class="justify-content-space-between">
            <a class="btn btn-secondary" href="{{url('stripe')}}">Pay later</a>
            <a type="submit" class="btn btn-primary">Pay with Paypall</a>
            <a class="btn btn-success" href="{{url('stripe')}}">Make with card</a>
        </div>
       
        
       

       
    </div>
</body>

</html>
