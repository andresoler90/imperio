@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row row-eq-height">
          <!-- Content Top Banner Start -->
          <div class="col-lg-4 col-md-12">
             <div class="iq-card">
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col">
                         <h5 class="card-title text-uppercase text-secondary mb-0 d-block">Live Users</h5>
                         <h2 class="mb-0 d-block">350</h2>
                      </div>
                      <div class="col-auto">
                         <div class="icon iq-icon-box rounded-circle iq-bg-primary rounded-circle">
                            <i class="ri-add-box-line"></i>
                         </div>
                      </div>
                   </div>
                </div>
                <div id="chart-9"></div>
             </div>
          </div>
          <div class="col-lg-2 col-md-6">
             <div class="iq-card wow zoomIn">
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12 mb-2 d-flex justify-content-between">
                         <div class="icon iq-icon-box rounded-circle iq-bg-warning rounded-circle">
                            <i class="ri-account-box-line"></i>
                         </div>
                      </div>
                      <div class="col-lg-12 mt-3">
                         <h6 class="card-title text-uppercase text-secondary mb-0">USERS</h6>
                         <span class="h2 text-dark mb-0 counter">850,789</span>
                      </div>
                   </div>
                   <p class="mb-0 text-muted mt-3">
                      <span class="text-success mr-2"><i class="ri-arrow-up-fill"></i> 3.48%</span>
                   </p>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-6">
             <div class="iq-card wow zoomIn">
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12 mb-2 d-flex justify-content-between">
                         <div class="icon iq-icon-box rounded-circle iq-bg-danger rounded-circle">
                            <i class="ri-account-box-line"></i>
                         </div>
                      </div>
                      <div class="col-lg-12 mt-3">
                         <h6 class="card-title text-uppercase text-secondary mb-0">SESSIONS</h6>
                         <span class="h2 text-dark mb-0 counter">810,084</span>
                      </div>
                   </div>
                   <p class="mb-0 text-muted mt-3">
                      <span class="text-danger mr-2"><i class="ri-arrow-down-fill"></i> 10%</span>
                   </p>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-6">
             <div class="iq-card wow zoomIn">
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12 mb-2 d-flex justify-content-between">
                         <div class="icon iq-icon-box rounded-circle iq-bg-success rounded-circle">
                            <i class="ri-timer-2-line"></i>
                         </div>
                      </div>
                      <div class="col-lg-12 mt-3">
                         <h6 class="card-title text-uppercase text-secondary mb-0">BOUNCE RATE</h6>
                         <span class="h2 text-dark mb-0 counter">47.6</span>
                      </div>
                   </div>
                   <p class="mb-0 text-muted mt-3">
                      <span class="text-success mr-2"><i class="ri-arrow-up-fill"></i> 6.48%</span>
                   </p>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-6">
             <div class="iq-card wow zoomIn">
                <div class="iq-card-body">
                   <div class="row">
                      <div class="col-lg-12 mb-2 d-flex justify-content-between">
                         <div class="icon iq-icon-box rounded-circle iq-bg-primary rounded-circle">
                            <i class="ri-timer-2-line"></i>
                         </div>
                      </div>
                      <div class="col-lg-12 mt-3">
                         <h6 class="card-title text-uppercase text-secondary mb-0">DURATION</h6>
                         <span class="h2 text-dark mb-0 counter">3.25</span>
                      </div>
                   </div>
                   <p class="mb-0 text-muted mt-3">
                      <span class="text-success mr-2"><i class="ri-arrow-up-fill"></i> 5.48%</span>
                   </p>
                </div>
             </div>
          </div>
       </div>
       <div class="row row-eq-height">
          <div class="col-lg-8 col-md-12">
             <div class="iq-card wow zoomIn" data-wow-delay="0.8s">
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
<!--                           <div id="chart-10"></div>-->
                         <div id="chartdiv" style="height: 500px;width: 100%"></div>
                </div>
             </div>
          </div>
          <div class="col-lg-4 col-md-12">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.6s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Devices</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                         View All
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
                   <div id="chart-6"></div>
                </div>
             </div>
          </div>
       </div>
       <div class="row row-eq-height">
          <div class="col-md-12 col-lg-8 mb-5 mb-xl-0">
             <div class="iq-card wow fadeInUp" data-wow-delay="0.8s">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Page visits</h4>
                   </div>
                   <div class="iq-card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                         <span class="dropdown-toggle dropdown-bg" id="dropdownMenuButton6" data-toggle="dropdown">
                         See all <i class="ri-arrow-down-s-line ml-1 text-primary"></i>
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
                         <span class="dropdown-toggle text-primary" id="dropdownMenuButton7" data-toggle="dropdown">
                         <i class="ri-more-2-fill"></i>
                         </span>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton7">
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
                            <div class="percentage float-right text-warning">85 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-warning" data-percent="85"></span>
                               </div>
                            </div>
                         </div>
                         <div class="iq-details mt-4">
                            <span class="title text-dark">Austrialia</span>
                            <div class="percentage float-right text-success">65 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-success" data-percent="65"></span>
                               </div>
                            </div>
                         </div>
                         <div class="iq-details mt-4">
                            <span class="title text-dark">Brazil</span>
                            <div class="percentage float-right text-danger">45 <span>%</span></div>
                            <div class="iq-progress-bar-linear d-inline-block w-100">
                               <div class="iq-progress-bar">
                                  <span class="bg-danger" data-percent="45"></span>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div id="chart-12"></div>
             </div>
          </div>
       </div>
    </div>
 </div>

@endsection
