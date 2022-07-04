@extends('master')
 
@section('title', '')

@section('alert')

@if(Session::has('alert_success'))
  @component('components.alert')
        @slot('class')
            success
        @endslot
        @slot('title')
            Terimakasih
        @endslot
        @slot('message')
            {{ session('alert_success') }}
        @endslot
  @endcomponent
@elseif(Session::has('alert_error'))
  @component('components.alert')
        @slot('class')
            error
        @endslot
        @slot('title')
            Cek Kembali
        @endslot
        @slot('message')
            {{ session('alert_error') }}
        @endslot
  @endcomponent 
@endif

@endsection
 
@section('content')

<div style="padding-bottom: 20px">
  <a  href="{{ route('create-user') }}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<div style="width: 100%; padding-left: -10px;">
<div class="table-responsive">
<table id="user_table" class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Tipe Akun</th>
            <th>Nomor HP</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
</div>

@endsection

@section('modal')

<div class="modal fade" id="detailModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">User Detail</p>
      </div>
      <div class="modal-body">

    <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control" value="" id="username">
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="text" class="form-control" value="" id="email">
    </div>

    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" value="" id="nama_lengkap">
    </div>

    <div class="form-group">
      <label for="sel1">Tipe Akun</label>
      <select class="form-control" id="tipe_akun">
        <option value="{{ User::ACCOUNT_TYPE_ADMIN }}" >Admin</option>
        <option value="{{ User::ACCOUNT_TYPE_TEACHER }}" >Guru</option>
				<option value="{{ User::ACCOUNT_TYPE_SISWA }}" >Siswa</option>
      </select>
    </div>

    <div class="form-group">
      <label>Tempat Lahir</label>
      <input type="text" class="form-control" value="" id="tempat_lahir">
    </div>

    <div class="form-group">
			<label>Tanggal Lahir</label>
			<input type="date" class="form-control" value="" id="tanggal_lahir">
		</div>

		<div class="form-group">
			<label>Jenis Kelamin</label>
      <div>
        <input type="hidden" id="jenis_kelamin" value="" name="jenis_kelamin" checked="checked"/>
        <input type="radio" id="jenis_kelamin" value="laki-laki" name="jenis_kelamin"/> Laki Laki
        <input type="radio" id="jenis_kelamin" value="perempuan" name="jenis_kelamin"/> Perempuan
      </div>
    </div>
    <label>Alamat</label>
    <textarea class="form-control" placeholder="" rows="3" id="alamat"></textarea>

    <div class="form-group">
      <label>Nomor HP</label>
      <input type="number" class="form-control" value="" id="no_hp">
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-right" id="non_aktif_button">Non Aktifkan</button>
        <button type="button" id="update_data" class="btn btn-default pull-left">Update</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updatePassword" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">Update Password</p>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="" id="username_password" disabled>
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" value="" id="password">
          </div>

          <div class="form-group">
            <label>Re Password</label>
            <input type="password" class="form-control" value="" id="password_confirmation">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="update_data_password" class="btn btn-default pull-left">Update Password</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

var iduser;
var table;

function clearAll(){
  $('#username').val('');
  $('#tipe_akun').val('');
  $('#email').val('');
  $('#tempat_lahir').val('');
  $('#tanggal_lahir').val('');
  $('#jenis_kelamin').val('');
  $('#no_hp').val('');
  $('#nama_lengkap').val('');
  $('#alamat').val('');
}

$(function () {
  table = $('#user_table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('index-user') }}",
      columns: [
          {data: 'full_name', name: 'full_name'},
          {data: 'email', name: 'email'},
          {data: 'jenis_kelamin', name: 'jenis_kelamin'},
          {data: 'account_type', name: 'tipe_akun'},
          {data: 'no_hp', name: 'no_hp'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function btnDel(id)
{
  iduser = id;
  
  swal({
      title: "Menon Aktifkan User",
      text: 'User yang telah dinon aktifkan tidak dapat diaktifkan kembali', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/user/delete',
        data:{
          iduser:iduser, 
          "_token": "{{ csrf_token() }}",},
        success:function(data) {
          
          if(data.status != false)
          {
            swal(data.message, { button:false, icon: "success", timer: 1000});
          }
          else
          {
            swal(data.message, { button:false, icon: "error", timer: 1000});
          }

          table.ajax.reload();
        },
        error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });      
    }
  });
}

function btnPass(id){

  $('#updatePassword').modal('toggle');

  iduser = id;

  $.ajax({
     type:'POST',
     url: base_url + '/user/get-detail',
     data:{iduser:iduser, "_token": "{{ csrf_token() }}",},
     success:function(data) {
        $('#username_password').val(data.data.username);
     },
     error: function(error) {
      swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
    }
  });
}

function btnUbah(id){

  $('#detailModal').modal('toggle');
  
  iduser = id;

  $.ajax({
     type:'POST',
     url: base_url + '/user/get-detail',
     data:{iduser:iduser, "_token": "{{ csrf_token() }}",},
     success:function(data) {
        $('#username').val(data.data.username);
        $('#email').val(data.data.email);
        $('#nama_lengkap').val(data.data.full_name);
        $('#tempat_lahir').val(data.data.tempat_lahir);
        $('#tanggal_lahir').val(data.data.tanggal_lahir);
        $('#jenis_kelamin').val(data.data.jenis_kelamin);
        $('#alamat').val(data.data.address);
        $('#no_hp').val(data.data.no_hp);
        $('#tipe_akun').val(data.data.account_type);
     }
  });
}

$( document ).ready(function() {

$('#non_aktif_button').click(function() { 
      btnDel(iduser)
      $("#detailModal .close").click()
})

$('#update_data_password').click(function() {

    var password = $('#password').val();
    var password_confirmation = $('#password_confirmation').val();

    $.ajax({
      type:'POST',
      url: base_url + '/user/update-password',
      data:
      {
        iduser:iduser, 
        "_token": "{{ csrf_token() }}",
        password : password,
        password_confirmation : password_confirmation,
      },
      success:function(data) {

        if(data.status != false)
        {
          swal(data.message, { button:false, icon: "success", timer: 1000});
          $("#updatePassword .close").click()
        }
        else
        {
          swal(data.message, { button:false, icon: "error", timer: 1000});
        }
      },
        error: function(error) {
          var err = eval("(" + error.responseText + ")");
          var array_1 = $.map(err, function(value, index) {
              return [value];
          });
          var array_2 = $.map(array_1, function(value, index) {
              return [value];
          });
          var message = JSON.stringify(array_2);
          swal(message, { button:false, icon: "error", timer: 1000});
        }
    });
})

$('#update_data').click(function() { 

    var username = $('#username').val();
    var email = $('#email').val();
    var full_name = $('#nama_lengkap').val();
    var tempat_lahir = $('#tempat_lahir').val();
    var tanggal_lahir = $('#tanggal_lahir').val();
    var jenis_kelamin = $('input[name=jenis_kelamin]:checked').val();
    console.log(jenis_kelamin);
    var address = $('#alamat').val();
    var no_hp = $('#no_hp').val();
    var account_type = $('#tipe_akun').val();

    $.ajax({
      type:'POST',
      url: base_url + '/user/update',
      data:{
        iduser:iduser, 
        "_token": "{{ csrf_token() }}",
        username : username,
        email : email,
        full_name : full_name,
        tempat_lahir : tempat_lahir,
        tanggal_lahir : tanggal_lahir,
        jenis_kelamin : jenis_kelamin,
        address : address,
        no_hp : no_hp,
        account_type : account_type
      },
      success:function(data) {
        if(data.status != false)
        {
          table.ajax.reload();
          swal(data.message, { button:false, icon: "success", timer: 1000});
          $("#detailModal .close").click();
          clearAll();
        }
      },
      error: function(error) {
        var err = eval("(" + error.responseText + ")");
        var array_1 = $.map(err, function(value, index) {
            return [value];
        });
        var array_2 = $.map(array_1, function(value, index) {
            return [value];
        });
        var message = JSON.stringify(array_2);
        swal(message, { button:false, icon: "error", timer: 1000});
      }
    });
})    

});

</script>

@endpush