@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
         
         <div class="table-responsive">
            @php
            //variable for total balance
               $sum_tot_balance = 0.0;
            @endphp
         <table class="table table-hover table-bordered">
         <thead>
            <tr style="background-color: gray">
               <th colspan="4"><h3>Accounts List</h3></th>
            </tr>
            <tr>
               <th>Account Number</th>
               <th>Account Type </th>
               <th>Balance</th>
               <th></th>
            </tr>
            <tbody>
            @foreach ($accounts as $key)
               <tr>
                  <td>{{ $key['account_number']}}</td>
                  <td>{{ $key['account_type']}}</td>
                  <td>{{ $key['balance']}}</td>
                  <td>
                     @if(($key['balance']  < -500 && $key['account_type'] = 'cheque') || ($key['balance']  < 0 && $key['account_type'] != 'cheque'))
                        <button class="btn btn-warning" data-toggle ="modal" data-target="#withdrawal" disabled> Withdraw </button>
                     @else
                        <button class="btn btn-success" data-toggle ="modal" data-target="#withdrawal"> Withdraw </button>
                     @endif
                  </td>
               </tr>
               @php $sum_tot_balance += $key['balance'] @endphp
            @endforeach
         </tbody>
         <tfoot style="font-size: 30px">
            <td>Balance</td>
            <td colspan="3">ZAR  {{$sum_tot_balance}}</td>
         </tfoot>   
      </table>
   </div>
</div>
</div>

<!--Model-->
<!-- The Modal -->
<div class="modal" id="withdrawal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title text-center">withdrawal</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <form id="product-form" action="{{url('withdrawal')}}" method="POST">
              
               {{ csrf_field() }}
            <div class="modal-body">
                  
                  <div class="form-group">
                     <label for="amount" class="col-form-label">Amount:</label>
                     <input type="text" class="form-control" id="amount" name="amount">
                  </div>
            
            </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="withdrawal">Make Withdrawal</button>
          </div>
         </form>
        </div>
      </div>
    </div>
</div>
@endsection