@extends('layouts.master')

@section('content')

<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12 col-lg-6">
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title"> Default Validation</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
                   <form>
                       {!! Form::open() !!}
                      <div class="form-row">
                         <div class="col-md-6 mb-3">
                             {!! Form::label('validat', 'First Name') !!}
                             {!! Form::text('name',null,array('class'=>'form-control','required')) !!}

                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'Last Name') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}

                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'User Name') !!}
                            <div class="input-group">
                               <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupPrepend2">@</span>
                               </div>
                               {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                            </div>
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'city') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'State') !!}
                            <select class="form-control" id="validationDefault04" required>
                               <option selected disabled value="">Choose...</option>
                               <option>...</option>
                            </select>
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'Zip') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                         </div>
                      </div>
                      <div class="form-group">

                         <div class="form-check">
                            {!! Form::checkbox('name',null,array('class'=>'form-check-input','required')) !!}
                            {!! Form::label('validat', 'Agree to terms and conditions') !!}
                         </div>
                      </div>
                      <div class="form-group">
                          {!! Form::submit('Submit form',array('class'=>'btn btn-primary')) !!}
                      </div>
                   {!! Form::close() !!}
                </div>
             </div>
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title"> Supported elements</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
                   {!! Form::open(array('class'=>'was-validated')) !!}
                   <div class="mb-3">
                     <label for="validationTextarea">Textarea</label>
                     <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required></textarea>
                     <div class="invalid-feedback">
                        Please enter a message in the textarea.
                     </div>
                  </div>
                  <div class="custom-control custom-checkbox mb-3">
                     <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
                     <label class="custom-control-label" for="customControlValidation1">Check this custom checkbox</label>
                     <div class="invalid-feedback">Example invalid feedback text</div>
                  </div>
                  <div class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                     <label class="custom-control-label" for="customControlValidation2">Toggle this custom radio</label>
                  </div>
                  <div class="custom-control custom-radio mb-3">
                     <input type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
                     <label class="custom-control-label" for="customControlValidation3">Or toggle this other custom radio</label>
                     <div class="invalid-feedback">More example invalid feedback text</div>
                  </div>
                  <div class="form-group">
                     <select class="custom-select" required>
                        <option value="">Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                     <div class="invalid-feedback">Example invalid custom select feedback</div>
                  </div>
                  <div class="custom-file">
                     <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                     <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                     <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>
                   {!! Form::close() !!}
                </div>
             </div>
          </div>
          <div class="col-sm-12 col-lg-6">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title"> Custom validation</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
                       {!! Form::open() !!}
                      <div class="form-row">
                         <div class="col-md-6 mb-3">
                             {!! Form::label('validat', 'First Name') !!}
                             {!! Form::text('name',null,array('class'=>'form-control','required')) !!}

                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'Last Name') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}

                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'User Name') !!}
                            <div class="input-group">
                               <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupPrepend2">@</span>
                               </div>
                               {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                            </div>
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'city') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'State') !!}
                            <select class="form-control" id="validationDefault04" required>
                               <option selected disabled value="">Choose...</option>
                               <option>...</option>
                            </select>
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'Zip') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                         </div>
                      </div>
                      <div class="form-group">

                         <div class="form-check">
                            {!! Form::checkbox('name',null,array('class'=>'form-check-input','required')) !!}
                            {!! Form::label('validat', 'Agree to terms and conditions') !!}
                         </div>
                      </div>
                      <div class="form-group">
                          {!! Form::submit('Submit form',array('class'=>'btn btn-primary')) !!}
                      </div>
                   {!! Form::close() !!}
                </div>
             </div>
             <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                   <div class="iq-header-title">
                      <h4 class="card-title">Tooltips</h4>
                   </div>
                </div>
                <div class="iq-card-body">
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p>
                   {!! Form::open() !!}
                      <div class="form-row">
                         <div class="col-md-6 mb-3">
                             {!! Form::label('validat', 'First Name') !!}
                             {!! Form::text('name',null,array('class'=>'form-control','required')) !!}

                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'Last Name') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}

                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'User Name') !!}
                            <div class="input-group">
                               <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupPrepend2">@</span>
                               </div>
                               {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                            </div>
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'city') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'State') !!}
                            <select class="form-control" id="validationDefault04" required>
                               <option selected disabled value="">Choose...</option>
                               <option>...</option>
                            </select>
                         </div>
                         <div class="col-md-6 mb-3">
                            {!! Form::label('validat', 'Zip') !!}
                            {!! Form::text('name',null,array('class'=>'form-control','required')) !!}
                         </div>
                      </div>
                      <div class="form-group">

                         <div class="form-check">
                            {!! Form::checkbox('name',null,array('class'=>'form-check-input','required')) !!}
                            {!! Form::label('validat', 'Agree to terms and conditions') !!}
                         </div>
                      </div>
                      <div class="form-group">
                          {!! Form::submit('Submit form',array('class'=>'btn btn-primary')) !!}
                      </div>
                   {!! Form::close() !!}
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
