@extends('frontEnd.layouts.master') 
@section('title','Register') 
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumbs" style="background: #db0022;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <!-- Bread Menu -->
                    <div class="bread-menu">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="#"> Sign Up</a></li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <!--<div class="bread-title"><h2>Merchant Sign Up</h2></div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / End Breadcrumb -->
<!-- Contact Us -->
<section class="contact-us">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">                
                <div class="mobile-register">
                    <div class="mobile-register-text">
                        <h5>Register Now</h5>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="phone-tab" data-toggle="tab" href="#phone" role="tab" aria-controls="phone" aria-selected="true">Mobile register</a>
                        </li>
                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false">Email register</a>-->
                        <!--</li>-->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="phone" role="tabpanel" aria-labelledby="phone-tab">
                            <div class="text-center">
                                <h3 class="h5 text-muted text-uppercase">become a merchant</h3>
                            </div>
                            <div class="mobile-register-area">
                                <form action="{{url('auth/merchant/register')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="companyName" required="" placeholder="Name of Business" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="firstName" required="" placeholder="Your Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phoneNumber" class="form-control" required="" placeholder="01XXXXXXXXX" />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" required="" placeholder="Password" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="password" name="confirmed" id="confirmed" class="form-control" required="" placeholder="Confirm Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="agree">
                                        <label class="form-check-label" for="exampleCheck1">I agree to <a href="{{url('termscondition')}}">terms and condition.</a></label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="submit">register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                            <div class="text-center">
                                <h3 class="h5 text-muted text-uppercase">become a merchant</h3>
                            </div>
                            <div class="mobile-register-area">
                                <form action="{{url('auth/merchant/register')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required="" name="companyName" placeholder="Name of Business" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required="" name="firstName" placeholder="Your Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" required="" name="emailAddress" placeholder="Email" />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="password" class="form-control" required="" name="password" placeholder="Password" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="password" class="form-control" required="" name="confirmed" id="confirmed" placeholder="Confirm Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2" value="1" name="agree">
                                        <label class="form-check-label" for="exampleCheck2">I agree to <a href="{{url('termscondition')}}">terms and condition.</a></label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="submit">register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
