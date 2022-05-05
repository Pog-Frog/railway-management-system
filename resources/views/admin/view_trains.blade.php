<?php

use App\Train;

$trains = Train::all();
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div style="overflow-x: auto;" class="p-3 my-3 border rounded">
        @csrf
        @if(Session::has('success'))
            <div class="alert-success">{{Session::get('success')}}

            </div>
        @else
            <div class="alert-danger">{{Session::get('fail')}}

            </div>
        @endif
        <table id="task-table" class="table table-r">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">ID</th>
                <th scope="col" style="text-align: center">number/name</th>
                <th scope="col" style="text-align: center">type</th>
                <th scope="col" style="text-align: center">number of cars</th>
                <th scope="col" style="text-align: center">status</th>
                <th scope="col" style="text-align: center">line</th>
                <th scope="col" style="text-align: center">captain</th>
                <th scope="col" style="text-align: center">updated at</th>
                <th scope="col" style="text-align: center">edit</th>
            </tr>
            </thead>

            <tbody>
            @foreach($trains as $train)
                    <tr>
                        <th scope="row">
                            <input type="type" style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;" name="train_id" value="{{$train->id}}" disabled>
                        </th>

                        <td style="text-align: center">
                            <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                                {{$train->number}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                @if(is_null($train->types))
                                    {{"not assigned"}}
                                @else
                                    {{$train->types->name}}
                                @endif
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$train->no_of_cars}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$train->status}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                @if(is_null($train->lines))
                                    {{"not assigned"}}
                                @else
                                    {{$train->lines->name}}
                                @endif
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                @if(is_null($train->captain))
                                    {{"not assigned"}}
                                @else
                                    {{$train->captains->name}}
                                @endif
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div style="max-width: 300px; max-height: 100px;overflow-y: auto;">
                                {{$train->updated_at}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('edit_train_index', ['train_id'=>($train->id)])}}">Edit</a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</main>
