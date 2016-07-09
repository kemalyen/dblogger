@extends('glog::layout.master')

@section('content')

 <form class="form-inline" action="" method="get">

     <div class="form-group">
         <label for="level">Level:</label>
         <select name="level" id="level" class="form-control">
         <option value=""> - - - - </option>
             @foreach($levels as $l)
                @if($l == $level)
                <option selected value="{{ $l }}">{{ $l }}</option>
                @else
                <option value="{{ $l }}">{{ $l }}</option>
                @endif
             @endforeach
         </select>
     </div>

     <div class="form-group">
         <label for="channels">Channels:</label>
         <select name="channels" id="channels"  class="form-control">
            <option value=""> - - - - </option>
             @foreach($channels as $m)
                @if($m == $message)
                <option selected value="{{ $m }}">{{ isset($translations[$m]) ? $translations[$m] : $m }}</option>
                @else
                <option value="{{ $m }}">{{ isset($translations[$m]) ? $translations[$m] : $m }}</option>
                @endif
             @endforeach
         </select>
     </div>

     <div class="form-group">
         <label for="datepicker_start">Start Date:</label>
         <input type="text" id="datepicker_start" name="start_date" class="form-control" >
     </div>

     <div class="form-group">
         <label for="datepicker_end">End Date:</label>
         <input type="text" id="datepicker_end" name="end_date" class="form-control" >
     </div>
   <button type="submit" class="btn btn-primary">Search</button>
</form>

<hr/>

@foreach($logs as $log)
    <div class="row">
        <div class="col-xs-12">
            <div class="vleft">
                <span class="label label-{{ $labels[$log->level_name] }}">{{ $log->level_name }}</span></td>
            </div>
            <div class="vright">
                <strong>{{ isset($translations[$log->channel]) ? $translations[$log->channel] : $log->channel }}</strong>
                <pre>{{ $log->context }}</pre>
                <div class="subtitle">
                    <span class="glyphicon glyphicon-time"></span> {{ $log->getDateDiff() }} |  {{ date('d F Y H:s:i', strtotime($log->created_at)) }}
                </div>
            </div>
        </div>
    </div>
@endforeach

{!! $logs->render() !!}
@endsection

@section('scripts')
    <script>
        $("#datepicker_start" ).datepicker();
        $("#datepicker_start" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        $("#datepicker_start" ).datepicker("setDate", '{{ $start_date }}');

        $("#datepicker_end" ).datepicker();
        $("#datepicker_end" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        $("#datepicker_end" ).datepicker("setDate", '{{ $end_date }}');
        $('select').select2();
    </script>
 @stop

