@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <a href="{{route('trans.create')}}" class="btn btn-primary">Create Transaction</a>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">Transaction(s) you created</div>

                <div class="card-body">
                   <ul class="list-group">
                      @forelse (auth()->user()->transactions()->latest()->get() as $transaction)
                        <li class="list-group-item d-flex justify-content-between">
                           <div>
                                {{$transaction->name}} to {{\App\User::nameOf($transaction->to_id)}}
                           </div>
                           <div>
                           <a href="{{route('trans.show',$transaction->id)}}" class="btn btn-secondary btn-sm">view details</a>
                           </div>
                        </li>
                      @empty
                          <li class="list-group-item">
                              No transaction created
                          </li>
                      @endforelse
                   </ul>
                </div>
            </div>
            @if (auth()->user()->transIn()->count())
            <div class="card mt-2">
                <div class="card-header">Transaction(s) you in</div>

                <div class="card-body">
                   <ul class="list-group">
                      @foreach (auth()->user()->transIn() as  $transaction)
                        <li class="list-group-item d-flex justify-content-between">
                           <div>
                                {{$transaction->name}} to {{\App\User::nameOf($transaction->to_id)}}
                           </div>
                           <div>
                           <a href="{{route('trans.show',$transaction->id)}}" class="btn btn-secondary btn-sm">view details</a>
                           </div>
                        </li>
                      @endforeach
                   </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
