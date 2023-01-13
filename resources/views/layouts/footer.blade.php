<div class="copy_right">
    <div class="copy_right_inner">
        <div class="copy_right_left">
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <div class="copy_right_center">
            <!--  <a href="{{ route('user.util') }}">Util</a> -->
            <a href="{{ route('user.disclaimer') }}">Disclaimer</a>
            <a href="{{ route('user.terms-of-use') }}">Terms of Use</a>
            <a href="{{ route('user.legal') }}">Legal</a>
            <a href="{{ route('user.privacy') }}">Privacy</a>
            <a href="{{ route('user.cookies') }}">Cookies</a>
        </div>
    </div>
</div>
<!-- ====================== POP UP PAGE =================== -->
@if (!session()->get('LoggedIn'))
    <div class="login_pop">
        <div class="box">
            <i class="fal login_pop_btn fa-times-circle"></i>
            <div class="image"><a href="{{ url('/') }}"><img src="{{ asset('front/images/Group 1157.png') }}"
                        alt=""></a></div>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <input type="text" placeholder="Username" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <button class="planner_btn" style="font-size: 21.846px;">Login</button>
            </form>
            {{-- <div class="social_links">
                <a href="#"><i class="fa fa-facebook-f"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus-g"></i></a>
            </div> --}}
            <br><p>Forgot password? <a href="{{ route('user.password-get') }}">Forget Password</a></p><br>
            <p>Not a member yet? <a href="{{ url('/signup') }}">Sign up</a></p>
        </div>
    </div>
@endif
<script src="{{ asset('front/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front/js/slick.js') }}"></script>
<script src="{{ asset('front/js/slick.min.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script src="{{ asset('js/iziToast.js') }}"></script>
@include('vendor.lara-izitoast.toast')
@stack('footer')
</body>

</html>
