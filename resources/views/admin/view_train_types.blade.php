<?php

use Illuminate\Support\Facades\DB;

$trains_types = DB::table('train_types')->get();
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
                <th scope="col" style="text-align: center">name</th>
                <th scope="col" style="text-align: center">delete</th>
            </tr>
            </thead>

            <tbody>
            @foreach($trains_types as $train_type)
                <tr>
                    <th scope="row">
                        <input type="type" style="max-width: 50px; max-height: 100px;overflow-y: auto; text-align: center;" name="train_type_id" value="{{$train_type->id}}" disabled>
                    </th>

                    <td style="text-align: center">
                        <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                            {{$train_type->name}}
                        </div>
                    </td>
                    <td style="text-align: center">
                        <form method="post" action="{{route('delete_train_type', ['type_id'=>($train_type->id)])}}">
                            @csrf
                            <div class="col text-center">
                                <button class="w-25 btn btn-primary btn-sm" type="submit">Delete Train</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</main>
