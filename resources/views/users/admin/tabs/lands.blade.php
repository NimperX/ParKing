
<div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Search : Land Space Name Or Address" id="search"> <span class="input-group-btn">
            <!-- <a href="/adminrefresh" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Refresh</a> -->
        </span>
    </div>
<br>
<br>
<table class="table">
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Landowner Name</th>
      <th scope="col">Park Name</th>
      <th scope="col">Address</th>
      <th scope="col">Verified</th>
      <th></th>
      
    </tr>
  </thead>
  <tbody id="parking">
    @foreach($parking_spaces as $parking_space)
    <tr>
      <th scope="row">{{$parking_space->id}}</th>
      <td>{{DB::table('landowners')->where('id',$parking_space->landowner_id)->value('first_name')}}</td>
      <td>{{$parking_space->name}}</td>
      <td>{{$parking_space->address}}</td>
      <td>{{$parking_space->verified=='1'?'Yes':'No'}}
      <td>
        @if($parking_space->verified!='1')
        <a href="/verifyland?land_id={{$parking_space->id}}">
          <button class="btn btn-outline-success" type="submit">Verify</button> 
        </a>
        @endif
      </td>
    </td>
      <!-- <td>{{$parking_space->admin_id}}</td> -->
      <td><?php
        $name = DB::table('admins')->where('id',$parking_space->admin_id)->value('first_name');
        echo $name;
      ?></td>
      <td>
          <form action="/landDetails" method="GET" role="search">
            <input type="hidden" value="{{$parking_space->id}}" name="landDetails_id">
            <button class="btn btn-outline-success" type="submit">View</button> 
          </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<script type="text/javascript">
  $('#search').on('keyup', function(){
    var value = $(this).val();
    $.ajax({
      type:'get',
      url:'{{URL::to('searchland')}}',
      data:{'q':value},
      success:function(data){
        $('tbody#parking').html(data);
      }
    });
  });
  $.ajaxSetup({
    headers: {
      'csrftoken' :'{{ csrf_token() }}'
    }
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>