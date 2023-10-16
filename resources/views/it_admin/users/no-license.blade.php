<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="mb-0">No License</h5>
                            </div>
                            <div class="col-md-4 text-right">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-primary"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="mr-2 fas fa-sign-out-alt"></i>
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <p>Sorry, you don't have the required license to access this feature.</p>
                        <p>For further information, please contact IT Support at:</p>
                        <a href="http://itsupport.caturpilar.com/" target="_blank">http://itsupport.caturpilar.com/</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
