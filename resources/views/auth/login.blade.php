{{--
<!doctype html>

<html class="no-js" lang="">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Login</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


</head>

<body class="bg-dark">

        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content" style="padding-top: 140px">

                    <div class="login-form">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V12</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="icon" type="image/png" href="{{ asset('assets/auth/') }}/images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/') }}/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" type="text/css"
    href="{{ asset('assets/auth/') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css" /> --}}

    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/auth/') }}/fonts/Linearicons-Free-v1.0.0/icon-font.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/') }}/vendor/animate/animate.css" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/auth/') }}/vendor/css-hamburgers/hamburgers.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/') }}/vendor/select2/select2.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth') }}/css/util.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth') }}/css/mainn.css" />

    <meta name="robots" content="noindex, follow" />
    <script nonce="5a138190-e5e7-46a6-acf0-094de2c06eec">
        (function(w, d) {
            !(function(Z, _, ba, bb) {
                Z.zarazData = Z.zarazData || {};
                Z.zarazData.executed = [];
                Z.zaraz = {
                    deferred: [],
                    listeners: []
                };
                Z.zaraz.q = [];
                Z.zaraz._f = function(bc) {
                    return function() {
                        var bd = Array.prototype.slice.call(arguments);
                        Z.zaraz.q.push({
                            m: bc,
                            a: bd
                        });
                    };
                };
                for (const be of ["track", "set", "debug"])
                    Z.zaraz[be] = Z.zaraz._f(be);
                Z.zaraz.init = () => {
                    var bf = _.getElementsByTagName(bb)[0],
                        bg = _.createElement(bb),
                        bh = _.getElementsByTagName("title")[0];
                    bh &&
                        (Z.zarazData.t =
                            _.getElementsByTagName("title")[0].text);
                    Z.zarazData.x = Math.random();
                    Z.zarazData.w = Z.screen.width;
                    Z.zarazData.h = Z.screen.height;
                    Z.zarazData.j = Z.innerHeight;
                    Z.zarazData.e = Z.innerWidth;
                    Z.zarazData.l = Z.location.href;
                    Z.zarazData.r = _.referrer;
                    Z.zarazData.k = Z.screen.colorDepth;
                    Z.zarazData.n = _.characterSet;
                    Z.zarazData.o = new Date().getTimezoneOffset();
                    Z.zarazData.q = [];
                    for (; Z.zaraz.q.length;) {
                        const bl = Z.zaraz.q.shift();
                        Z.zarazData.q.push(bl);
                    }
                    bg.defer = !0;
                    for (const bm of [localStorage, sessionStorage])
                        Object.keys(bm || {})
                        .filter((bo) => bo.startsWith("_zaraz_"))
                        .forEach((bn) => {
                            try {
                                Z.zarazData["z_" + bn.slice(7)] =
                                    JSON.parse(bm.getItem(bn));
                            } catch {
                                Z.zarazData["z_" + bn.slice(7)] =
                                    bm.getItem(bn);
                            }
                        });
                    bg.referrerPolicy = "origin";
                    bg.src =
                        "/assets/auth/js/s.js?z=" +
                        btoa(
                            encodeURIComponent(JSON.stringify(Z.zarazData))
                        );
                    bf.parentNode.insertBefore(bg, bf);
                };
                ["complete", "interactive"].includes(_.readyState) ?
                    zaraz.init() :
                    Z.addEventListener("DOMContentLoaded", zaraz.init);
            })(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url({{ asset('assets/auth/images/img-01.jpg') }})">
            <div class="wrap-login100 p-t-190 p-b-30">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="login100-form-avatar">
                        <img src="{{ asset('assets/auth') }}/images/avatar-01.jpg" alt="AVATAR" />
                    </div>
                    <span class="login100-form-title p-t-20 p-b-45">
                        Silahkan Login!
                    </span>
                    <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                        <input class="input100" type="email" name="email" placeholder="Email" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    {{-- <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div> --}}
                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/auth/') }}/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="{{ asset('assets/auth/') }}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('assets/auth/') }}/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/auth/') }}/vendor/select2/select2.min.js"></script>

    <script src="{{ asset('assets/auth/') }}/js/main.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-23581568-13");
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"75e34e0d2a076bbd","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.10.3","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
