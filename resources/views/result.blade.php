@include('header')
@foreach($result as $row)
    <div class="row col-6">
        <div class="col-1 id">
            {{$row->id}}
        </div>
        <div class="col-3 domain">
            {{$row->domainname}}
        </div>
        <div class="col-2 keyword">
            {{$row->keyword}}
        </div>
        <div class="col-2 position">
            {{$row->position}}
        </div>
        <div class="col-4 date">
            {{$row->query_time}}
        </div>
    </div>
@endforeach
