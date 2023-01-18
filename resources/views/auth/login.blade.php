<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('admin_login/mian.css') }}">
    <title>login</title>
</head>

<body>
    <div class="login">
        <div class="container">
            <div class="parent-boxs row">
                <div class="box form col-lg-6">
                    <div class="parent-head custom-head">
                        <div class="logo">
                            <img src="{{ url('admin_login/logo/logo-c.png') }}" alt="" loading="lazy">
                        </div>
                        <div class="head">
                            <div>
                                <p>
                                    ليس لديك حساب؟
                                </p>
                            </div>
                            <div>
                                <button>
                                    <a href="{{ url('https://r7seven.com/#/auth/register') }}">
                                        التسجيل
                                    </a>
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="title">
                        <h2>
                            مرحباً!اهلاً بعودتك.
                        </h2>
                        <p>
                            سجل بيانات حسابك الذي سبق وادحلته اثناء التسجيل.
                        </p>
                    </div>
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="email">
                            <label for="">البريد الالتكتروني </label>
                            <input type="text" placeholder="example@example.com" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}"  autocomplete="email" autofocus>
                        </div>
                        <div class="email pass">
                            <div class="labels">
                                <label for="">كلمه المرور</label>
                                <label for="" class="forget-pass"><a href="#">هل نسيت كلمه المرور؟</a></label>
                            </div>
                            <input type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="current-password">
                        </div>
                        <div class="footer">
                            <button>
                                    تسجيل دخول
                            </button>
                        </div>
                       
                            @foreach(['danger','warning','success','info'] as $msg)
                            @if(Session::has('alert-'.$msg))
                            <div class="alert alert-warning text-center">
                                <span>
                                    {{Session::get('alert-'.$msg)}}
                                </span>
                             </div>
                            @endif
                        @endforeach
                    </form>
                </div>
                <div class="box img col-lg-6">
                    <div class="user-img">
                        <img src="{{ url('admin_login/user.png')}}" alt="user" loading="lazy">
                    </div>
                    <div class="title">
                        <p>
                            اهلاٌ بك في أرسفن
                        </p>
                        <img class="logo" src="{{ url('admin_login/logo.png')}}" alt="" loading="lazy">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>