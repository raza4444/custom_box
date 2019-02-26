<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
<title>{{$PageTitle}} {{($PageTitle !="")? "|":""}} {{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}</title>
<meta name="description" content="{{$PageDescription}}"/>
<meta name="keywords" content="{{$PageKeywords}}"/>
<meta name="author" content="{{ URL::to('') }}"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!--css -->
<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet"/>

<link href="{{ URL::asset('front_end/css/style.css') }}" rel="stylesheet"/>
 <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/bootstrap.min.css') }}">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/font-awesome.min.css') }}">
        <!-- Ionicons Font CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/ionicons.min.css') }}">
        <!-- Ionicons Font CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/ionicons/css') }}">
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/plugins.css') }}">
        <!-- Helper CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/helper.css') }}">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{ URL::asset('front_end/css/style.css') }}">
        <!-- Modernizer JS -->
        <script src="{{ URL::asset('front_end/js/vendor/modernizr-2.8.3.min.js') }}"></script>
<!-- Favicon and Touch Icons -->
@if(Helper::GeneralSiteSettings("style_fav") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_fav")) }}" rel="shortcut icon"
          type="image/png">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
@endif

@if(Helper::GeneralSiteSettings("style_apple") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="144x144">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
@endif
@if($WebmasterSettings->google_tags_status && $WebmasterSettings->google_tags_id !="")
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{!! $WebmasterSettings->google_tags_id !!}');</script>
    <!-- End Google Tag Manager -->
@endif
</head>
