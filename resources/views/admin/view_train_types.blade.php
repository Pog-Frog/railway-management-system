<?php

use App\Train_type;

$trains_types = Train_type::all();
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
                    <td style="text-align: center">
                        <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                            {{$train_type->id}}
                        </div>
                    </td>

                    <td style="text-align: center">
                        <div style="max-width: 500px;max-height: 100px;overflow-y: auto;">
                            {{$train_type->name}}
                        </div>
                    </td>
                    <td style="text-align: center">
                        <a href="{{route('edit_train_type_index', ['train_type_id'=>($train_type->id)])}}">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</main>
