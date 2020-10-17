@extends('layouts.app')

@section('content')
<?php 
$currency =  setting_by_key("currency");
?>
 <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All Sales</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Sales Date</th>
                            <th>Discount</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (!empty($sales))
                        @forelse ($sales as $key => $sale)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sale->customer['name'] }}</td>
                                <td>{{ $sale->created_at->format('d F Y') }}</td>
								<td>{{$currency}} {{ $sale->discount }}</td>
                                <td>{{$currency}} {{ ($sale->amount )}}</td>
									@if($sale->status == 1)  
								<td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-xs ">Completed</a>
                                </td>
									@else
								<td>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-xs">Canceled</a>
                                </td>
									@endif
								
								
                                <td>
								<a href="{{ url('sales/cancel/' . $sale->id) }}" class="btn btn-danger btn-xs pull-right">Cancel It</a>
                                    <a target="_blank" href="{{ url('sales/receipt/' . $sale->id) }}" class="btn btn-primary btn-xs pull-right">@lang('common.show')</a>
                                </td>
                            </tr>
                        @empty
                           <tr> 
						  <td colspan="5">
								 @lang('common.no_record_found')
									
                                </td>
								</tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
				{!! $sales->render() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection