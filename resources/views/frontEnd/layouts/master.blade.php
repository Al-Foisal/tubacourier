<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content='pavilan'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Tag  -->
    <title>@yield('title','always on time')</title>
    <!-- Favicon -->
    
    @foreach($whitelogo as $value)
    <link rel="icon" type="image/favicon.png" href="{{asset('fav.png')}}">
    @endforeach

    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- datatable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap4.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/animate.min.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/font-awesome.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/magnific-popup.min.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/owl-carousel.min.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/slicknav.min.css">
    <link rel="stylesheet" href="{{asset('backEnd/')}}/dist/css/toastr.min.css">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/reset.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('frontEnd/')}}/css/responsive.css">

    <style>
        .section-title h1 span {
            background: #ed1e26;
        }
        .header .text-logo a, .header .img-logo a{
            margin-bottom: 11px;
        }
    </style>
</head>

<body id="bg">
    <!-- Boxed Layout -->
    <div id="page" class="site boxed-layout">
        <!-- Header -->
        <header class="header">            
            <!-- Middle Header -->
            <div class="middle-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="middle-inner">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-12">
                                        <!-- Logo -->
                                        <div class="logo">
                                            <!-- Image Logo -->
                                            <div class="img-logo">
                                                <a href="{{url('/')}}">
                                                @foreach($whitelogo as $wlogo)
                                                    <img src="{{asset($wlogo->image)}}" alt="">
                                                @endforeach
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mobile-nav"></div>
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-12">
                                        <div class="menu-area">
                                            <!-- Main Menu -->
                                            <nav class="navbar navbar-expand-lg">
                                                <div class="navbar-collapse">
                                                    <div class="nav-inner">
                                                        <div class="menu-home-menu-container">
                                                            <!-- Naviagiton -->
                                                            <ul id="nav" class="nav main-menu menu navbar-nav">
                                                                <li class="nav-item"><a href="{{url('/')}}">Home</a></li>
                                                                <li class="nav-item custom-dropdown"><a> Services <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                                    <ul class="custom-dropdown-menu">
                                                                    @foreach($services as $key=>$value)
                                                                        <li><a href="{{url('our-service/'.$value->id)}}"><i class="fa {{$value->icon}}"></i>{{$value->title}}</a></li>
                                                                    @endforeach
                                                                    </ul>
                                                                </li>
                                                                <li class="nav-item"><a href="{{url('price')}}">Charges</a></li>
                                                                <!-- <li><a href="{{url('about-us')}}">About Us</a></li> -->
                                                                <li class="nav-item"><a href="{{url('pick-drop')}}">Pick & Drop</a></li>
                                                                <li class="nav-item"><a href="{{url('branches')}}">Branches</a></li>
                                                                <li class="nav-item" style="font-size:13px"><a href="{{url('covarage/list')}}">Covarage Area</a></li>
                                                                <li class="nav-item"><a href="{{url('notice')}}">Notice</a></li>
                                                                <li class="nav-item"><a href="{{url('contact-us')}}">Contact</a></li>
                                                                <div class="button">
                                                                    @if(session('merchantId'))
                                                                    
                                                                    <a href="{{url('merchant/dashboard')}}" class="quickTech-btn login">Dashboard</a>
                                                                    
                                                                   
                                                                    @else
                                                                     <a href="{{url('merchant/register')}}" class="quickTech-btn register">Register</a>
                                                                    <a href="{{url('merchant/login')}}" class="quickTech-btn login">Login</a>
                                                                    
                                                                    @endif
                                                                </div>
                                                            </ul>
                                                            <!--/ End Naviagiton -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </nav>
                                            <!--/ End Main Menu -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Middle Header -->
            
            
            <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "103196405632399");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

        </header>
        <!--/ End Header -->
        
        
        
        
        @yield('content')
        <!-- Footer -->
        <footer class="footer" style="background-image: url({{asset('frontEnd/images/footer.svg')}});">
            <!-- Footer Top -->
            <div class="footer-top" style="background:black">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Footer Links -->
                            <div class="single-widget f-link widget">
                                <h3 class="widget-title">Services</h3>
                                <ul>
                                    <li><a href="{{url('/')}}">Home Delivery</a></li>
                                    <li><a href="{{url('/')}}">Warehousing</a></li>
                                    <li><a href="{{url('/')}}">Pick and Drop</a></li>
                                </ul>
                            </div>
                            <!--/ End Footer Links -->
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <!-- Footer Links -->
                            <div class="single-widget f-link widget">
                                <h3 class="widget-title">Earn</h3>
                                <ul>
                                    <li><a href="{{url('/')}}">Become Merchant</a></li>
                                    <li><a href="{{url('/')}}">Become Rider</a></li>
                                    <li><a href="{{url('/')}}">Become Delivery Man</a></li>
                                </ul>
                            </div>
                            <!--/ End Footer Links -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Footer Links -->
                            <div class="single-widget f-link widget">
                                <h3 class="widget-title">Company</h3>
                                <ul>
                                    <li><a href="{{url('about-us')}}">About Us</a></li>
                                    <li><a href="{{url('/')}}">Our Goal</a></li>
                                    <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
                                    <!--<li><a href="{{url('contact-us')}}">Contact us</a></li>-->
                                </ul>
                            </div>
                            <!--/ End Footer Links -->
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Footer Contact -->
                            <div class="single-widget footer_contact widget">
                                <h3 class="widget-title">Contact</h3>
                                <p>Don’t miss any updates of our Offer</p>
                                <div class="newsletter">
                                    <form action="" class="d-flex flex-nowrap">
                                        <div class="form-group h-100 m-0 p-2 w-100">
                                            <input type="email" placeholder="Email Address" class="form-control px-1 bg-transparent h-100 border-0 without-focus" />
                                        </div>
                                        <button type="button" class="bg-white btn font-20 font-light m-1">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                            <!--/ End Footer Contact -->
                        </div>
                    </div>

                </div>
            </div>
            
            
            
            
            
        
            <!-- Copyright -->
            <div class="copyright" style="background:black;">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-4">
                            <div class="copyright-content">
                                <div class="img-logo text-left" style="background:black;">
                                    <a href="{{url('/')}}">
                                    @foreach($darklogo as $wlogo)
                                        <img src="{{asset($wlogo->image)}}" alt="">
                                    @endforeach
                                    </a>
                                </div>
                                
                                
                                <ul class="address-widget-list">
                                {{--    <li class="footer-mobile-number"><i class="fa fa-phone"></i>+8809611677587</li> --}}
                                    <li class="footer-mobile-number"><i class="fa fa-mobile-phone"></i></i>+01310271166</li>
                                    <li class="footer-mobile-number"><i class="fa fa-envelope"></i> support@tubacourier.com </li>
                                    <li class="footer-mobile-number"><i class="fa fa-map-marker"></i>Metro housing,Mohammadpur,Dhaka 1207</li>
                                </ul>
                                
                                
                            </div>
                        </div>
                        
                      
                        <div class="col-sm-4">
                            <div class="align-items-center copyright-content d-flex justify-content-center">
                                <!-- Copyright Text -->
                                <p>©2022 Tuba Courier. All rights reserved</p>
                            </div>
                        </div>
               
                        
                        
                      <!--<div class="col-sm-3">-->
                      <!--      <div class="align-items-center copyright-content d-flex justify-content-end">-->
                                
                      <!--          <ul class="social-widget-list">-->
                      <!--              @foreach($socialmedia as $key=>$value)-->
                      <!--              <li class="footer-mobile-number"><a href="{{$value->link}}"><i class="{{$value->icon}}"></i></a></li>-->
                      <!--              @endforeach-->
                      <!--          </ul>-->
                      <!--      </div>-->
                      <!--  </div> -->
                        
                        
          <div class="col-sm-4"> 
          <div class="d-flex flex-column">
                    
                        <p>
                            
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<a href="/Tuba Courier.apk" download="Tuba Courier">
  
  <div class="d-flex justify-content-center align-items-center flex-column">
  <img src="/google_app.png" alt="Tuba Courier Marchant" width="180" height="142">
  
  
    <ul class="social-widget-list mt-2">
                                    @foreach($socialmedia as $key=>$value)
                                    <li class="footer-mobile-number"><a href="{{$value->link}}"><i class="{{$value->icon}}"></i></a></li>
                                    @endforeach
    </ul>
    
    </div>
  
</p>

<!--<p>Rider App<br>-->
<!--<a href="/Tuba Courier Rider.apk" download="Tuba Courier Rider">-->
<!--  <img src="/google_app.png" alt="Tuba Courier Rider" width="180" height="142">-->
<!--</p>  -->
<!--</a>  -->
   </div>   
   </div>
       </div>                 
                    </div>
                   

<br>

{{-- <p>Merchant App
<a href="/Tuba Courier.apk" download="Tuba Courier">
  <img src="/google_app.png" alt="Tuba Courier Marchant" width="180" height="142">
</p>

<p>Rider App--->
<a href="/Tuba Courier Rider.apk" download="Tuba Courier Rider">
  <img src="/google_app.png" alt="Tuba Courier Rider" width="180" height="142">
</p>  
</a>  --}}

<br>
<br>
<br>
<br>
                    
                </div>

            </div>
            <!--/ End Copyright -->
            
            
            
            
   

        </footer>
        
 
 

        
        

        <!-- Jquery JS -->
        <script src="{{asset('frontEnd/')}}/js/jquery.min.js"></script>
        <script src="{{asset('frontEnd/')}}/js/jquery-migrate-3.0.0.js"></script>
        <!-- Popper JS -->
        <script src="{{asset('frontEnd/')}}/js/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('frontEnd/')}}/js/bootstrap.min.js"></script>
        <!-- Modernizr JS -->
        <script src="{{asset('frontEnd/')}}/js/modernizr.min.js"></script>
        <!-- ScrollUp JS -->
        <script src="{{asset('frontEnd/')}}/js/scrollup.js"></script>
        <!-- FacnyBox JS -->
        <script src="{{asset('frontEnd/')}}/js/jquery-fancybox.min.js"></script>
        <!-- Cube Portfolio JS -->
        <script src="{{asset('frontEnd/')}}/js/cubeportfolio.min.js"></script>
        <!-- Slick Nav JS -->
        <script src="{{asset('frontEnd/')}}/js/slicknav.min.js"></script>
        <!-- Slick Nav JS -->
        <script src="{{asset('frontEnd/')}}/js/slicknav.min.js"></script>
        <!-- Slick Slider JS -->
        <script src="{{asset('frontEnd/')}}/js/owl-carousel.min.js"></script>
        <!-- Easing JS -->
        <script src="{{asset('frontEnd/')}}/js/easing.js"></script>
        <!-- Magnipic Popup JS -->
        <script src="{{asset('frontEnd/')}}/js/magnific-popup.min.js"></script>
        <!-- Active JS -->
        <script src="{{asset('frontEnd/')}}/js/active.js"></script>
        <script src="{{asset('backEnd/')}}/dist/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        <!-- Datatable -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="{{asset('backEnd/')}}/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{{asset('backEnd/')}}/plugins/datatables/dataTables.bootstrap4.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
        <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js "></script>
        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        
        <script>
    
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
       rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
      
    });
</script>
</body>


</html>
<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "109961004701121");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    

    
    
    
    
    
    