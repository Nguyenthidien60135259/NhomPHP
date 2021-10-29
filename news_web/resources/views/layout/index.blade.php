<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Trang chủ</title>
    <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
            <style type="text/css">
             

footer{
     position: relative;
     width: 100%;
     height: auto;
     padding: 50px 100px;
     background: #111;
     display: flex;
     justify-content: space-between;
     flex-wrap: wrap;
 }
footer .container{
     display: flex;
     justify-content: space-between;
     flex-wrap: wrap;
     flex-direction: row;
 }
 footer .container .noi-dung{
     margin-right: 30px;
 }
footer  .container .noi-dung.about{
     width:40%;
 }
 footer .container .noi-dung.about h2{
     position: relative;
     color: #fff;
     font-weight: 500;
     margin-bottom: 15px;
 }
 footer .container .noi-dung.about h2:before{
     content: '';
     position: absolute;
     bottom: -5px;
     left: 0;
     width: 50px;
     height: 2px;
     background: #f00;
 }
footer .container .noi-dung.about p{
     color: #999;
 }
 /*Thiết Lập Cho Thành Phần Icon Mạng Xã Hội*/
 .social-icon{
     margin-top: 20px;
     display: flex;
 }
footer .social-icon li {
     list-style: none;
 }
 footer .social-icon li a{
     display: inline-block;
     width: 40px;
     height: 40px;
     background: #222;
     display: flex;
     justify-content: center;
     align-items: center;
     margin-right: 10px;
     text-decoration: none;
     border-radius: 4px;
 }
footer .social-icon li a:hover{
     background: #f00;
 }
footer .social-icon li a .fa{
     color: #fff;
     font-size: 20px;
 }
.links h2{
     position: relative;
     color: #fff;
     font-weight: 500;
     margin-bottom: 15px;
 }.links h2{
     position: relative;
     color: #fff;
     font-weight: 500;
     margin-bottom: 15px;
 }
.links h2::before{
     content: '';
     position: absolute;
     bottom: -5px;
     left: 0;
     width: 50px;
     height: 2px;
     background: #f00;
 }
.links{
    position: relative;
    width: 25%;
 }
 footer .links ul li{
     list-style: none;
 }
 footer .links ul li a{
     color: #999;
     text-decoration: none;
     margin-bottom: 10px;
     display: inline-block;
 }
footer .links ul li a:hover{
     color: #fff;
 }
 .contact h2{
     position: relative;
     color: #fff;
     font-weight: 500;
     margin-bottom: 15px;
 }
.contact h2::before{
     content: '';
     position: absolute;
     bottom: -5px;
     left: 0;
     width: 50px;
     height: 2px;
     background: #f00;
 }
.contact{
     width: calc(35% - 60px);
     margin-right: 0 !important;
 }
.contact .info{
     position: relative;
 }
footer .contact .info li{
     display: flex;
     margin-bottom: 16px;
 }
 footer .contact .info li span:nth-child(1) {
     color: #fff;
     font-size: 20px;
     margin-right: 10px;
 }
footer .contact .info li span{
     color: #999;
 }
footer .contact .info li a{
     color: #999;
     text-decoration: none;
 }
 footer .btn {
     display: inline-block;
     background: transparent;
     color: inherit;
     font: inherit;
     border: 0;
     outline: 0;
     padding: 0;
     margin-top:16px;
     transition: all 200ms ease-in;
     cursor: pointer;
 }
 footer .btn--primary {
     background: #222;
     color: #fff;
     box-shadow: 0 0 10px 2px rgba(0, 0, 0, .1);
     border-radius: 2px;
     padding: 8px 24px;
 }
 footer .btn--primary:hover {
     background: #f00;
 }
 footer .btn--primary:active {
     background: #f00;
     box-shadow: inset 0 0 10px 2px rgba(0, 0, 0, .2);
 }
footer .form__field {
     width: 90%;
     background: #fff;
     color: #a3a3a3;
     font: inherit;
     box-shadow: 0 6px 10px 0 rgba(0, 0, 0, .1);
     border: 0;
     outline: 0;
     padding: 8px 4px;
 }
 @media  (max-width: 768px){
     footer{
         padding: 40px;
              }
     footer .container{
         flex-direction: column;
     }
     footer .container .noi-dung{
         margin-right: 0;
         margin-bottom: 40px;
     }
     footer .container, .noi-dung.about, .links, .contact{
         width: 100%;
     }
 }
            </style>

</head>

<body>

    @include('layout.header')
   

   	@yield('content')

    @include('layout.footer')
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>

    @yield('script')

</body>

</html>

