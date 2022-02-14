@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row row-eq-height">
            <!-- Content Top Banner Start -->
            <div class="col-lg-3 col-md-12">
                <div class="iq-card iq-profile-card text-center">
                    <div class="iq-card-body">
                        <div class="iq-team text-center p-0">
                            <img src={{asset("assets/images/user/1.jpg")}}
                                 class="img-fluid mb-3 avatar-120 rounded-circle" alt="">
                            <h4 class="mb-0">Nik Jordan</h4>
                            <a href="#" class="d-inline-block w-100">nik@sofboxadmin.com</a>
                            <p class="mt-1">1234 North Avenue Luke Lane, South Bend, IN 360001</p>
                            <hr>
                            <ul class="list-inline mb-0 d-flex justify-content-between">
                                <li class="list-inline-item">
                                    <h5>Blood</h5>
                                    <p class="text-success">AB+</p>
                                </li>
                                <li class="list-inline-item">
                                    <h5>Height</h5>
                                    <p class="text-success">161cm</p>
                                </li>
                                <li class="list-inline-item">
                                    <h5>Weight</h5>
                                    <p class="text-success">64kg</p>
                                </li>
                            </ul>
                        </div>
                        <div id="Dash1BarChart"></div>
                    </div>
                </div>
                <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Notifications</h4>
                        </div>
                        <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="#" class="">See all</a>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="media">
                            <img class="mr-3 rounded-circle" src={{asset("assets/images/user/01.jpg")}}
                                 alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">Dr. Jay <small
                                        class="text-muted font-size-12">Yesterday</small></h5>
                                <i class="ri-close-line float-right"></i>
                                <p>Lorem Ipsum is simply dummy text.</p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <img class="mr-3 rounded-circle" src={{asset("assets/images/user/02.jpg")}}
                                 alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">Dr. Lilly <small
                                        class="text-muted font-size-12">Yesterday</small></h5>
                                <i class="ri-close-line float-right"></i>
                                <p>Lorem Ipsum is simply dummy text.</p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <img class="mr-3 rounded-circle" src={{asset("assets/images/user/03.jpg")}}
                                 alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">Dr. Steve <small
                                        class="text-muted font-size-12">Yesterday</small></h5>
                                <i class="ri-close-line float-right"></i>
                                <p>Lorem Ipsum is simply dummy text.</p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <img class="mr-3 rounded-circle" src={{asset("assets/images/user/04.jpg")}}
                                 alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0">Dr. Mia <small
                                        class="text-muted font-size-12">Yesterday</small></h5>
                                <i class="ri-close-line float-right"></i>
                                <p>Lorem Ipsum is simply dummy text.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-card">
                    <div class="iq-card-body border-0 border text-center">
                        <span class="font-size-20 font-weight-bold text-uppercase">Pro</span>
                        <h2 class="mb-4 display-3 font-weight-bolder"><small
                                class="font-size-16 align-text-top">$ </small>19<small
                                class="font-size-14 text-muted">USD / month</small></h2>
                        <ul class="list-unstyled line-height-4 mb-0">
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>Nulla volutpat aliquam velit</li>
                        </ul>
                        <a href="#" class="btn btn-primary mt-5">Start Starter</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Summary</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                   <span class="dropdown-toggle text-primary" id="dropdownMenuButton2"
                                         data-toggle="dropdown">
                                   View All
                                   </span>
                                        <div class="dropdown-menu dropdown-menu-right"
                                             aria-labelledby="dropdownMenuButton2">
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-eye-fill mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-file-download-fill mr-2"></i>Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="iq-card shadow-none mb-0">
                                            <div class="iq-card-body p-1">
                                                <span class="text-dark float-right"><i
                                                        class="ri-arrow-up-fill mr-1"></i>+30%</span>
                                                <span class="font-size-14">Blood pressure</span>
                                                <h2>75
                                                    <img class="float-right summary-image-top mt-1" src={{asset("assets/images/page-img/04.png")}} alt="summary-image" /> </h2>
                                                <div class="iq-progress-bar-linear d-inline-block w-100 mt-3">
                                                    <div class="iq-progress-bar">
                                                        <span class="bg-primary" data-percent="90"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="iq-card shadow-none mb-0">
                                            <div class="iq-card-body p-1">
                                                <span class="text-dark float-right"><i
                                                        class="ri-arrow-up-fill mr-1"></i>+30%</span>
                                                <span class="font-size-14">Temperature</span>
                                                <h2>28.6
                                                <img class="float-right summary-image-top mt-1" src="{{ asset('assets/images/page-img/06.png') }}" alt="summary-image" /> </h2>
                                                <div class="iq-progress-bar-linear d-inline-block w-100 mt-3">
                                                    <div class="iq-progress-bar">
                                                        <span class="bg-success" data-percent="90"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="iq-card shadow-none mb-0">
                                            <div class="iq-card-body p-1">
                                                <span class="text-dark float-right"><i
                                                        class="ri-arrow-down-fill mr-1"></i>+30%</span>
                                                <span class="font-size-14">Heart Rate</span>
                                                <h2>60
                                                <img class="float-right summary-image-top mt-1" src={{asset("assets/images/page-img/05.png")}} alt="summary-image" /> </h2>
                                                <div class="iq-progress-bar-linear d-inline-block w-100 mt-3">
                                                    <div class="iq-progress-bar">
                                                        <span class="bg-danger" data-percent="90"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="iq-card overflow-hidden wow fadeInUp" data-wow-delay="0.6s">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Statistics</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton1"
                                              data-toggle="dropdown">26 Aug 2019</span>
                                        <div class="dropdown-menu dropdown-menu-right"
                                             aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-eye-fill mr-2"></i>View</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-file-download-fill mr-2"></i>Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card-body p-0">
                                <div id="chart-20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Diet Plan</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <a href="#" class="">See all</a>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false"
                                     data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1"
                                     data-items-mobile="1" data-items-mobile-sm="1" data-margin="30">
                                    <div class="item">
                                        <div class="">
                                            <a class="mb-3 d-block font-size-16" href="#"><i
                                                    class="ri-pencil-ruler-2-line mr-1"></i>Breakfast</a>
                                            <h5 class="mb-2">Meal plan is for a person aged 19-50 years.</h5>
                                            <p>
                                              Wholegrain toast with polyunsaturated margarine
                                              2 slices toast.
                                              2 teaspoon margarine.
                                              20g cheese2 teaspoon margarine.
                                              1 cup mixed salad vegetables.Unsalted nuts	30g	1 meat.</p>
                                            <button type="button" class="btn btn-primary mt-3">Read More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Appointments</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <a href="#" class="dropdown-bg"><i class="ri-add-line mr-2"></i>Book Appointment</a>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div id='eventcalendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('body_bottom')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('eventcalendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'timeGrid', 'dayGrid', 'list' ],
            timeZone: 'UTC',
            defaultView: 'dayGridMonth',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: [
            {
                title: 'All Day Event',
                start: '2019-12-01'
            },
            {
                title: 'Long Event',
                start: '2019-12-07',
                end: '2019-12-10',
                color: 'purple' // override!
            },
            {
                groupId: '999',
                title: 'Repeating Event',
                start: '2019-12-09T16:00:00'
            },
            {
                groupId: '999',
                title: 'Repeating Event',
                start: '2019-12-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2019-12-11',
                end: '2019-12-13',
                color: 'purple' // override!
            },
            {
                title: 'Meeting',
                start: '2019-12-12T10:30:00',
                end: '2019-12-12T12:30:00',
                color: 'red'
            },
            {
                title: 'Lunch',
                start: '2019-12-12T12:00:00',
                color: 'green'
            },
            {
                title: 'Meeting',
                start: '2019-12-12T14:30:00'
            },
            {
                title: 'Birthday Party',
                start: '2020-01-02T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2020-01-15'
            }]
        });
        calendar.render();
    });
</script>
@endsection
