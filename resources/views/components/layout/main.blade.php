<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polly's website</title>
{{--    <link rel="stylesheet" href="css/style.css">--}}
{{--    <link rel="stylesheet" href="css/index.css">--}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
{{--    <script src="js/aside_bar.js"></script>--}}
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/aside_bad.js'])--}}
@vite(['public/css/style.css', 'public/js/aside_bar.js'])
</head>

<body>
<nav class="navbar">
    <header class="header">
        <a href="{{route('index')}}" class="logo">Polly</a>

        <ul>
            <li><a href="{{route('index')}}">Home</a></li>
            <li><a href="{{route('profile')}}">Profile</a></li>
            <li><a href="{{route('faq')}}">FAQ</a></li>
            <li><a href="{{route('blog')}}">Blog</a></li>
        </ul>

        @auth
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        @endauth

{{--        <div id="mySidenav" class="sidenav"><br>--}}
{{--            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>--}}
{{--            <a target="_blank"--}}
{{--               href="https://hz.nl/uploads/documents/1.4-Over-de-HZ/1.4.3.-Regelingen-en-documenten/OERS/2023-2024/Juli/CER-HZ-Bachelor-full-time-2023-2024-DEF-version-20230720.pdf">HZ--}}
{{--                HBO-ICT Course and Exam Regultaions</a>--}}
{{--            <a target="_blank"--}}
{{--               href="https://hz.nl/uploads/documents/1.4-Over-de-HZ/1.4.3.-Regelingen-en-documenten/OERS/2023-2024/Juli/TWE/IR-B-HBO-ICT-full-time-2023-2024-DEF.pdf">The--}}
{{--                implementation Regulations</a>--}}
{{--            <a target="_blank" href="https://learn.hz.nl/my/">Learn environment</a>--}}
{{--            <a target="_blank"--}}
{{--               href="https://teams.microsoft.com/_#/school/conversations/General?threadId=19:2e2afa0286b04932be16cb8ad2d9d2c0@thread.skype&ctx=channel">MS--}}
{{--                Teams</a>--}}
{{--            <a target="_blank" href="#">MyHZ progress</a>--}}
{{--            <a target="_blank" href="https://github.com/HZ-HBO-ICT">GitHub</a>--}}
{{--        </div>--}}
{{--        <span style="font-size:30px; cursor:pointer" onclick="openNav()">&#9776;</span>--}}
    </header>
</nav>

{{$slot}}

<footer>
    <div class="HZ-logo">
        <img src="images/HZ.png" alt="HZ logo">
    </div>
    <div class="button">
        <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=polidandreti@gmail.com"><button
                type="button">Mail me</button></a>
    </div>
    <div class="foot">
        <a target="_blank" href="https://www.facebook.com/profile.php?id=100009165588640"><i
                class='bx bxl-facebook-circle'></i></a>
        <a target="_blank" href="https://www.instagram.com/polly.vladimirova/?hl=en"><i class='bx bxl-instagram'></i></a>
        <a target="_blank"
           href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_MjkzM2M0MDktZjgyNS00MGNhLWE0MDUtMjFlNWFlOTI0Yzhm%40thread.v2/0?context=%7b%22Tid%22%3a%224c16deb3-342d-4fca-bcd5-b1429308034c%22%2c%22Oid%22%3a%223c244253-fc8c-43c5-b861-535ab98e471a%22%7d"><i
                class='bx bxl-microsoft-teams'></i></a>
    </div>
</footer>

</body>

</html>
