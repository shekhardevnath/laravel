<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	{{ HTML::style('/css/main.css') }}
</head>
<body>
	<div id='container'>
		<div id='header'>
			{{ HTML::link('/', 'Make It Snappy Q&A') }}
		</div><!-- 	end header -->
		<div id='nav'>
			<ul>
				<li> {{ HTML::linkRoute('home', 'Home') }} </li>
				@if(!Auth::check())
				  <li> {{ HTML::linkRoute('register', 'Register') }} </li>
				  <li> {{ HTML::linkRoute('login', 'Login') }} </li>
				@else
				  <li> {{ HTML::linkRoute('your_questions', 'Your Q\'s') }} </li>
				  <li> {{ HTML::linkRoute('logout', 'Logout (' . Auth::user()->username . ')') }} </li>
				@endif
			</ul>
		</div><!-- end nav -->
		<div id='content'>
			@if(Session::has('message'))
			   <p id='message'> {{ Session::get('message') }} </p>
			@endif
			
			@yield('content')   
		</div><!-- end content -->
		<div id='footer'>
			&copy; Make It Snappy Q&A {{ date('Y') }}
		</div><!-- end footer -->
	</div><!-- end container -->
</body>
</html>