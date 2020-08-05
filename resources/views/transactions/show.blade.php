@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transaction Details</div>

                <div class="card-body">
                    <div>
                        <strong>
                            trans. Name : 
                        </strong>
                        <span>
                            {{$transaction->name}}
                        </span>
                    </div>
                    <div>
                        <strong>
                            trans. created : 
                        </strong>
                        <span>
                            {{$transaction->created_at->format('M-d-Y')}}
                        </span>
                    </div>
                    <div>
                        <strong>
                            No. Records :
                        </strong>
                        <span>
                            {{$transaction->records()->count()}}
                        </span>
                        /
                        <strong>
                            Total Amout : 
                        </strong>
                        <span>
                            P {{number_format($transaction->records()->sum('amount'),2)}}
                        </span>
                    </div>
                    @if (auth()->user()->id == $transaction->user_id)
                    <div>
                        <strong>
                            trans. to :
                        </strong>
                        <span>
                            {{\App\User::nameOf($transaction->to_id)}}
                        </span>
                    </div>
                    @else
                    <div>
                        <strong>
                            trans.from :
                        </strong>
                        <span>
                            {{\App\User::nameOf($transaction->user_id)}}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @can('update', $transaction)
            <div class="card mt-2">
                <div class="card-header">
                    Add new Record here
                </div>
                <div class="card-body">
                    <form action="{{route('rec.store',$transaction->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Absolute Amount</label>
                            <input id="amount" class="form-control" required type="text" name="amount" min="1" placeholder="example : 500">
                        </div>
                        <div class="form-group">
                            <label for="Details">Details <small class="text-muted">(optional)</small></label>
                            <textarea id="Details" class="form-control" name="details" rows="3" placeholder="details for this record"></textarea>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-outline-primary">
                    </form>
                </div>
            </div>
            @endcan

            <div class="card mt-2">
                <div class="card-header">
                    Trans. Records
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Ammount
                            </th>
                            <th>
                                Details
                            </th>
                        </tr>
                        @forelse ($transaction->records()->latest()->get() as $record)
                            <tr>
                                <td>
                                    {{$record->created_at->format('M-d-Y')}}
                                </td>
                                <td>
                                    P {{number_format($record->amount,2)}}
                                </td>
                                <td>
                                    {{$record->details ?? '---'}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    No records to show...
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
