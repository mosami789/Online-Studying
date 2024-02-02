<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link rel="icon" type="image/png" href="assets/images/icon.png">
    <link href="css.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">

<style>
.headerapp{
    background-color: rgba(250, 250, 251, 0.9);
    box-shadow: 0 0.46875rem 2.1875rem rgba(4,9,20,0.03), 0 0.9375rem 1.40625rem rgba(4,9,20,0.03), 0 0.25rem 0.53125rem rgba(4,9,20,0.05), 0 0.125rem 0.1875rem rgba(4,9,20,0.03);
};
    
.closed-sidebar {margin-left:80px;}
.app-main{flex:1;display:flex;z-index:8;position:relative}
.app-main .app-main__outer{flex:1;flex-direction:column;display:flex;z-index:12}
.app-main .app-main__inner{padding:30px 30px 0;flex:1}
.app-theme-white.app-container{background:#f1f4f6}
.app-theme-white .app-sidebar{background:#fff}
.app-theme-white .app-page-title{background:rgba(255,255,255,0.45)}
.app-theme-white ,.app-theme-white .app-header{background:#fafbfc}
.app-theme-white.fixed-header .app-header__logo{background:rgba(250,251,252,0.1)}

.footer{
    box-shadow:0.3rem -0.46875rem 2.1875rem rgba(4,9,20,0.02),0.3rem -0.9375rem 1.40625rem rgba(4,9,20,0.02),0.3rem -0.25rem 0.53125rem rgba(4,9,20,0.04),0.3rem -0.125rem 0.1875rem rgba(4,9,20,0.02);
    height:60px;
    background-color: #f8f9fa!important;
}

.filup{
    visibility: visible; 
    animation-duration: 300ms; 
    animation-name: fadeInUp;
}
</style>


</head>
<body id="body">
    <div class="app-container app-theme-white body-tabs-shadow">

        <nav class="navbar navbar-expand-lg navbar-light headerapp">
            <a class="navbar-brand text-white" href="home.php"><img src="assets/images/logo-inverse.png" class="img-fluid"></a>
            <button style="background-color: rgba(250, 250, 250, 0.6); border-radius: 8px;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
            
                </ul>
                <span class="navbar-text">
                <a style="border-radius: 20px;" href="home.php?page=login" type="click" class="btn btn-success btn-lg text-white" type="button">Login</a>
                <a style="border-radius: 20px;" href="home.php?page=register" type="click" class="btn btn-primary btn-lg ml-2 text-white" type="button">Register Account</a>
                </span>
            </div>
        </nav>