@extends('frontEnd.layouts.master')
@section('title','Login')
@section('content')
<!-- Breadcrumb -->
        <div class="breadcrumbs" style="background:#db0022;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-inner">
                            <!-- Bread Menu -->
                            <div class="bread-menu">
                                <ul>
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="#">Log In</a></li>
                                </ul>
                            </div>
                            <!-- Bread Title -->
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
                        <h5>Login Now</h5>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="phone-tab" data-toggle="tab" href="#phone" role="tab" aria-controls="phone" aria-selected="true">Mobile login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false">Email login</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="phone" role="tabpanel" aria-labelledby="phone-tab">
                            <div class="mobile-register-area">
                                <form action="{{url('merchant/login')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phoneOremail" required="" placeholder="01XXXXXXXXX" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" required="" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="submit">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                            <div class="mobile-register-area">
                                <form action="{{url('merchant/login')}}" method="POST">
                                    @csrf                                    
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="phoneOremail" required="" placeholder="Email" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" required="" placeholder="Password" />
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="submit">login</button>
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