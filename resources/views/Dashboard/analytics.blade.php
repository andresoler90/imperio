@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row row-eq-height">
          <div class="col-lg-4 col-md-12">
             <div class="row">
                <div class="col-md-6">
                   <div class="iq-card">
                      <div class="iq-card-body">
                         <div class="row">
                            <div class="col-lg-12 mb-2 d-flex justify-content-between">
                               <div class="icon iq-icon-box rounded-circle iq-bg-primary rounded-circle" data-wow-delay="0.2s">
                                  <i class="ri-account-box-line"></i>
                               </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                               <h6 class="card-title text-uppercase text-secondary mb-0">Users</h6>
                               <span class="h2 text-dark mb-0 counter d-inline-block w-100">91,586</span>
                            </div>
                         </div>
                         <p class="mb-0 text-muted mt-3">
                            <span class="text-success mr-2"><i class="ri-arrow-up-fill"></i> 3.48%</span>
                         </p>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="iq-card">
                      <div class="iq-card-body">
                         <div class="row">
                            <div class="col-lg-12 mb-2 d-flex justify-content-between">
                               <div class="icon iq-icon-box rounded-circle iq-bg-danger rounded-circle" data-wow-delay="0.2s">
                                  <i class="ri-window-line"></i>
                               </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                               <h6 class="card-title text-uppercase text-secondary mb-0">Session</h6>
                               <span class="h2 text-dark mb-0 counter d-inline-block w-100">750,897</span>
                            </div>
                         </div>
                         <p class="mb-0 text-muted mt-3">
                            <span class="text-danger mr-2"><i class="ri-arrow-down-fill"></i> 10%</span>
                         </p>
                      </div>
                   </div>
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                   <div class="iq-card">
                      <div class="iq-card-body">
                         <div class="row">
                            <div class="col-lg-12 mb-2 d-flex justify-content-between">
                               <div class="icon iq-icon-box rounded-circle iq-bg-success rounded-circle" data-wow-delay="0.2s">
                                  <i class="ri-clockwise-2-line"></i>
                               </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                               <h6 class="card-title text-uppercase text-secondary mb-0">Bounce Rate</h6>
                               <span class="h2 text-dark mb-0 counter d-inline-block w-100">45.8</span>
                            </div>
                         </div>
                         <p class="mb-0 text-muted mt-3">
                            <span class="text-success mr-2"><i class="ri-arrow-up-fill"></i> 5.17%</span>
                         </p>
                      </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="iq-card">
                      <div class="iq-card-body">
                         <div class="row">
                            <div class="col-lg-12 mb-2 d-flex justify-content-between">
                               <div class="icon iq-icon-box rounded-circle iq-bg-info rounded-circle" data-wow-delay="0.2s">
                                  <i class="ri-timer-2-line"></i>
                               </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                               <h6 class="card-title text-uppercase text-secondary mb-0">Duration</h6>
                               <span class="h2 text-dark mb-0 counter d-inline-block w-100">3.21</span>
                            </div>
                         </div>
                         <p class="mb-0 text-muted mt-3">
                            <span class="text-success mr-2"><i class="ri-arrow-up-fill"></i> 8.48%</span>
                         </p>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-lg-8 col-md-12">
             <div class="iq-card" data-wow-delay="0.8s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Analytics</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <ul class="nav nav-pills">
                         <li class="nav-item">
                            <a href="#" class="nav-link active">Days</a>
                         </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">Weeks</a>
                         </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">Months</a>
                         </li>
                      </ul>
                   </div>
                </div>
                <div class="iq-card-body p-0">
                   <div class="d-flex justify-content-around mt-4">
                      <div class="price-week-box mr-5">
                         <span>Active Users</span>
                         <h2><span class="counter">380</span> <i class="ri-funds-line text-success font-size-18"></i></h2>
                      </div>
                      <div class="price-week-box">
                         <span>User retention</span>
                         <h2><span class="counter">52.55</span><i class="ri-funds-line text-success font-size-18"></i></h2>
                      </div>
                   </div>
                   <div id="chart-19"></div>
                </div>
             </div>
          </div>
       </div>
       <div class="row row-eq-height">
          <div class="col-md-6 col-lg-3">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Devices</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle text-primary" id="dropdownMenuButton2" data-toggle="dropdown">
                         View All
                         </span>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="iq-card-body p-0">
                   <div id="chart-13"></div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Users</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle text-primary" id="dropdownMenuButton3" data-toggle="dropdown">
                         <i class="ri-more-2-fill"></i>
                         </span>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton3">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="iq-card-body">
                   <div id="chart-15"></div>
                </div>
             </div>
          </div>
          <div class="col-lg-6 col-md-12 mb-5 mb-xl-0">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.8s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Page Metrics</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle text-primary" id="dropdownMenuButton4" data-toggle="dropdown">
                         <i class="ri-more-2-fill"></i>
                         </span>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton4">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="iq-card-body">
                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                   <div class="row">
                      <div class="col-md-6">
                         <div id="chart-14"></div>
                      </div>
                      <div class="col-md-6 align-self-center">
                         <div class="row">
                            <div class="col-md-12">
                               <h5 class="text-dark mb-0">Our goal</h5>
                               <h2 class="text-primary">85%<small class="ml-3">Traffic</small></h2>
                            </div>
                         </div>
                         <hr>
                         <div class="row">
                            <div class="col-md-12">
                               <h6 class="d-inline-block w-100 mb-2">Previous scores</h6>
                               <h5>August<span class="ml-3 font-size-22 text-success">69%</span></h5>
                               <h5>September<span class="ml-3 font-size-22 text-danger">40%</span></h5>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="row row-eq-height">
          <div class="col-lg-8 col-md-12 mb-5 mb-xl-0">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.8s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Page visits</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle dropdown-bg" id="dropdownMenuButton5" data-toggle="dropdown">
                         See all <i class="ri-arrow-down-s-line ml-1 text-primary"></i>
                         </span>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="iq-card-body">
                   <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center table-flush">
                         <thead class="thead-light">
                            <tr>
                               <th scope="col">Page name</th>
                               <th scope="col">Visitors</th>
                               <th scope="col">Unique users</th>
                               <th scope="col">Bounce rate</th>
                            </tr>
                         </thead>
                         <tbody>
                            <tr>
                               <th scope="row">
                                  /Home
                               </th>
                               <td>
                                  4,569
                               </td>
                               <td>
                                  340
                               </td>
                               <td>
                                  <i class="ri-arrow-up-fill text-success mr-3"></i> 46,53%
                               </td>
                            </tr>
                            <tr>
                               <th scope="row">
                                  /Dashboard1/index.html
                               </th>
                               <td>
                                  3,985
                               </td>
                               <td>
                                  319
                               </td>
                               <td>
                                  <i class="ri-arrow-down-fill text-warning mr-3"></i> 46,53%
                               </td>
                            </tr>
                            <tr>
                               <th scope="row">
                                  /Dashboard1/charts.html
                               </th>
                               <td>
                                  3,513
                               </td>
                               <td>
                                  294
                               </td>
                               <td>
                                  <i class="ri-arrow-down-fill text-warning mr-3"></i> 36,49%
                               </td>
                            </tr>
                            <tr>
                               <th scope="row">
                                  /Dashboard1/tables.html
                               </th>
                               <td>
                                  2,050
                               </td>
                               <td>
                                  147
                               </td>
                               <td>
                                  <i class="ri-arrow-up-fill text-success mr-3"></i> 50,87%
                               </td>
                            </tr>
                            <tr>
                               <th scope="row">
                                  /Dashboard1/profile.html
                               </th>
                               <td>
                                  1,795
                               </td>
                               <td>
                                  190
                               </td>
                               <td>
                                  <i class="ri-arrow-down-fill text-danger mr-3"></i> 46,53%
                               </td>
                            </tr>
                            <tr>
                               <th scope="row">
                                  /Dashboard1/pricing.html
                               </th>
                               <td>
                                  8,395
                               </td>
                               <td>
                                  8190
                               </td>
                               <td>
                                  <i class="ri-arrow-down-fill text-danger mr-3"></i> 46,53%
                               </td>
                            </tr>
                            <tr>
                               <th scope="row">
                                  /Dashboard1/Signup.html
                               </th>
                               <td>
                                  4,562
                               </td>
                               <td>
                                  4190
                               </td>
                               <td>
                                  <i class="ri-arrow-down-fill text-danger mr-3"></i> 46,53%
                               </td>
                            </tr>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-lg-4">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.8s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Countries</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle text-primary" id="dropdownMenuButton6" data-toggle="dropdown">
                         <i class="ri-more-2-fill"></i>
                         </span>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                            <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                            <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                            <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                            <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="iq-details">
                            <span class="title text-dark">United States</span>
                            <div class="percentage float-right text-primary">95 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-primary" data-percent="95"></span>
                               </div>
                            </div>
                         </div>
                         <div class="iq-details mt-4">
                            <span class="title text-dark">India</span>
                            <div class="percentage float-right text-warning">75 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-warning" data-percent="75"></span>
                               </div>
                            </div>
                         </div>
                         <div class="iq-details mt-4">
                            <span class="title text-dark">Australia</span>
                            <div class="percentage float-right text-success">55 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-success" data-percent="55"></span>
                               </div>
                            </div>
                         </div>
                         <div class="iq-details mt-4">
                            <span class="title text-dark">Brazil</span>
                            <div class="percentage float-right text-danger">25 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-danger" data-percent="25"></span>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div id="bar-chart-12"></div>
             </div>
          </div>
       </div>
    </div>
 </div>

@endsection
