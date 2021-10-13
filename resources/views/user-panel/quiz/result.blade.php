@extends('user-panel.layouts.app')
@section('title','কুইজ')

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr class="quiz-bg text-white" style="font-size: 14px;">
            <th>কুইজ</th>
            <!--<th>নম্বর</th>-->
             <th>সময়</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($results as $result)
            <?php
            $time=(($result->seconds) / 60);
            ?>
        <tr>
            <td>{{$result->quiz->title}}</td>
            <!--<td>{{EnToBn($result->mark)}}</td>-->
           <td>
               @if($result->seconds > 59)
                   <span class="font-weight-bold">{{EnToBn(round($time,2). 'মিনিট')}}</span>
               @else
                   <span class=" font-weight-bold">{{EnToBn($result->seconds. ' '.'সেকেন্ড')}} </span>
               @endif
           </td>
            <td>
                <a href="{{route('result.view',lock($result->quiz->id.'-'.Auth::id()))}}" class="btn btn-primary text-center btn-sm"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="4" class="text-danger text-center"><i class="fas fa-times-circle"></i> Empty</td>

            </tr>
        @endforelse
        </tbody>
    </table>

@stop
