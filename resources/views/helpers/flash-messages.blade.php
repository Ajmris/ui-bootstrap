@if(session('status'))
    <div class="row align-items-center mb-3">
        <div class="col-12">
            <div class="alert alert-success">
                {{session('status')}}
                <button class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
            </div>
        </div>
    </div>
@endif