<div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            @if (count($errors->all()) > 0)
            <div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>Error - Please check the form below for errors</h4>
            </div>
            @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Error</h4>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Warning</h4>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
            @endif

            @if ($message = Session::get('info'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Info</h4>
                @if(is_array($message))
                @foreach ($message as $m)
                {{ $m }}
                @endforeach
                @else
                {{ $message }}
                @endif
            </div>
            @endif
    </div>
</div>
