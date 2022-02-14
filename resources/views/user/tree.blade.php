@extends('layouts.master')
@section('styles')
    {{Html::style('css/tree.css')}}
@endsection
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="body genealogy-body genealogy-scroll">
                        <div class="genealogy-tree">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="member-view-box">
                                            <div class="member-image">
                                                @if(Auth::user()->rank)
                                                    <img src="{{asset(Auth::user()->rank->image)}}"
                                                         alt="Member">
                                                @else
                                                    <img src="{{asset("assets/images/rank/1.png")}}"
                                                         alt="Member">
                                                @endif

                                                <div class="member-details">
                                                    <h3>
                                                        {{--@switch(Auth::user()->position_preference)
                                                            @case('D')
                                                            Ⓓ
                                                            @break
                                                            @case('I')
                                                            Ⓘ
                                                            @break
                                                        @endswitch--}}
                                                        {{--Se comenta las palabras D I--}}
                                                        {{Auth::user()->username}}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    {!! $multilevel->tree() !!}

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.genealogy-tree ul').hide();
            $('.genealogy-tree>ul').show();
            $('.genealogy-tree ul.active').show();
            $('.genealogy-tree li').on('click', function (e) {
                var children = $(this).find('> ul');
                if (children.is(":visible")) children.hide('fast').removeClass('active');
                else children.show('fast').addClass('active');
                e.stopPropagation();
            });
        });

    </script>
@endsection
