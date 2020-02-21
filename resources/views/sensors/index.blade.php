@extends('layouts.main')

@section('page_title',$page_title)


@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader">
        <div>
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="index.html">{{config('app.name')}}</a>
                <span class="breadcrumb-item active">{{$page_title}}</span>

            </nav>

        </div>
    </div><!-- br-pageheader -->


    <div class="br-pagebody">

        <div class="row">

            <div class="col-lg-8 mg-b-20">
                <div class="br-section-wrapper" style="padding: 30px 20px">
                    <div style="align">
                        <span class="tx-bold tx-18"><i class="icon ion ion-ionic tx-22"></i> {{$page_title}}</span>
                        <a href="{{url('sensors/group') }}">
                            <button class="btn btn-sm btn-info float-right"><i
                                    class="icon ion ion-search"></i> Scan Sensor</button>
                        </a>
                    </div>
                    <hr>
                    @if(session()->has('create'))
                    <div class="alert alert-success wd-50p">
                        {{ session()->get('create') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session()->has('update'))
                    <div class="alert alert-warning wd-50p">
                        {{ session()->get('update') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif


                    @if(session()->has('delete'))
                    <div class="alert alert-danger wd-50p">
                        {{ session()->get('delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    @endif
                    <div class="table-wrapper ">
                        <table class="table display responsive nowrap" id="datatable1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Remark</th>
                                    <th>Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                @endphp
                                @foreach ($sensors as $sensor)


                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $sensor->name }}</td>
                                    <td>{{ $sensor->remark }}</td>
                                    <td>{{ ($sensor->status==1) ? 'Active' :'Deactivate'  }}</td>
                                   

                                    <td>
                                       @if (!$sensor->status)
                                           <a href="{{url('sensors/'.$sensor->id.'/activate')}}" class="btn btn-sm btn-success"> <i class="icon icon ion ion-checkmark-round"></i> Active</a>
                                       @else
                                        <a href="{{url('sensors/'.$sensor->id.'/deactivate')}}">
                                            <button class="btn btn-pink btn-sm text-white">
                                                <i class="icon icon ion ion-close-round"></i> Deactivate
                                            </button>
                                        </a>
                                       @endif 

                                        <a href="{{url('sensors/'.$sensor->id.'/edit')}}">
                                            <button class="btn btn-warning btn-sm text-white">
                                                <i class="icon icon ion ion-edit"></i> Edit
                                            </button>
                                        </a>
                                        <button class="btn btn-danger btn-sm text-white"
                                            onclick="deleteData({{$sensor->id}})">
                                            <i class="icon icon ion ion-ios-trash-outline"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    {{-- {{ $users->link    s() }} --}}
                </div>

            </div>

        </div>

    </div><!-- br-pagebody -->

    @include('layouts.partials.footer')
</div><!-- br-mainpanel -->\

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('js')
<script>
    
    var route_url= 'sensors'; 
  
    

</script>
@endpush
