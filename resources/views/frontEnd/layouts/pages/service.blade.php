@extends('frontEnd.layouts.master')
@section('title','Our Service')
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
                            <li><a href="">{{$servicedetails->title}}</a></li>
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / End Breadcrumb -->

   <!-- About Section start -->
     <div class="about-area section-padding bg-gray">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-12 col-xs-12 info">
                     <div class="about-wrapper wow fadeInLeft" data-wow-delay="0.3s">
                         <div>
                             <div class="site-heading">
                                 <h2 class="section-title">{{$servicedetails->title}}</h2>
                             </div>
                             <div class="content">
                                 <p>
                                    {!! $servicedetails->text !!}
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-12 col-xs-12 wow fadeInRight" data-wow-delay="0.3s">
                     <img class="img-fluid" src="{{asset($servicedetails->image)}}" alt="">
                 </div>
             </div>
         </div>
     </div>
             <!-- Call To Action Section Start -->
     <section id="cta" class="section-padding bg-gray">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-6 col-xs-12 wow fadeInLeft" data-wow-delay="0.3s">
                     <div class="cta-text">
                         <h4>Get 30 days free trial</h4>
                         <p>Praesent imperdiet, tellus et euismod euismod, risus lorem euismod erat, at finibus neque odio quis metus. Donec vulputate arcu quam. </p>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-xs-12 text-right wow fadeInRight" data-wow-delay="0.3s">
                     <a href="{{url('/')}}" class="btn btn-common">Register Now</a>
                 </div>
             </div>
         </div>
     </section>
     <!-- Call To Action Section Start -->
@endsection