@include('partials.errors_toast')
@php($route = Auth::user() ? 'user.ticket.store' : 'register')

<form method="POST" action="{{ route($route) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="countries_id">{{__('Categorias')}}</label>
            {{Form::select('category_id',$categories,null,['class'=>'custom-select','id'=>'category_id','placeholder'=>'Seleccione...'])}}
            @error('category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="countries_id">{{__('Prioridades')}}</label>
            {{Form::select('priority_id',$priorities,null,['class'=>'custom-select','id'=>'category_id','placeholder'=>'Seleccione...'])}}
            @error('priority_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="subject">{{__('Asunto')}}</label>
            <input id="subject" type="text"
                   class="form-control mb-0 @error('subject') is-invalid @enderror" name="subject"
                   value="{{ old('subject') }}" required autocomplete="name" autofocus>
            @error('subject')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="message">{{__('Mensaje')}}</label>
            <textarea id="message" type="text"
                      class="form-control mb-0 @error('message') is-invalid @enderror" name="message"
                      value="{{ old('message') }}" required autocomplete="name" autofocus>
            </textarea>
            @error('message')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            <input class="custom-file-input mb-0 @error('subject') is-invalid @enderror" name="file" id="file" name="file" type="file"
                   accept="application/gif,image/jpeg,image/png,image/jpg,image/JPG"
                   value="{{isset($data->file)?$data->file:old('file')}}">
            <label class="custom-file-label" for="file">Choose file</label>
            @error('file')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
    <div class="d-inline-block w-100">
        <button type="submit" class="btn btn-primary float-right">{{__('Guardar')}}</button>
    </div>
</form>
@section('scripts')
    <script type="text/javascript">
        $('.custom-file-input').on('change', function () {
            var fileName = $(this).val();
            var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
            $(this).next('.custom-file-label').html(cleanFileName);
        })

        ClassicEditor
            .create( document.querySelector( '#message' ),{
                toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'insertTable', 'undo', 'redo'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
            })
            .catch( error => {
                console.error( error );
            });
    </script>
@endsection
