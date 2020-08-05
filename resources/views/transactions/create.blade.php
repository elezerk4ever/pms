@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new transaction</div>

                <div class="card-body">
                <form action="{{route('trans.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Transaction name</label>
                            <input id="name" class="form-control" type="text" name="name" required placeholder="name of your transaction">
                        </div>
                        <div class="form-group">
                            <label for="to">Transaction to</label>
                            <select id="to" class="form-control" name="to_id" required>
                                <option selected disabled>Choose users</option>
                                @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Submit" class="btn btn-outline-primary">
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
