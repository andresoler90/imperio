@include('partials._body_style')
<div class="container-fluid" style="background-color: white">
    <div class="row">

        <div class="col-sm-6 align-self-center">

            <div class="sign-in-from">
                <h1 class="mb-0  pt-3">{{$user->username}}</h1>
                @include('Authentication.partials.form_registration',['sponsor'=>$user->username])
            </div>
        </div>
        <div class="col-sm-6 text-center">
            <div class="sign-in-detail text-white"
                 style="background: url(assets/images/login/2.jpg) no-repeat 0 0; background-size: cover;">
                <a class="sign-in-logo mb-5" href="#"><img
                        src={{asset("assets/images/logo-white.png")}} class="img-fluid" alt="logo"></a>
                <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true"
                     data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1"
                     data-items-mobile-sm="1" data-margin="0">
                    <div class="item">
                        <img class="profile-pic"
                             src="{{ asset(isset($user->contactInformation->url_image) ? $user->contactInformation->url_image : 'assets/images/user/11.png') }}"
                             alt="{{isset($user->contactInformation->url_image) ?$user->contactInformation->url_image : 'user-image'}}">
                        <h4 class="mb-1 text-white">Manage your orders</h4>
                        <p>It is a long established fact that a reader will be distracted by the readable
                            content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._body_footer')

